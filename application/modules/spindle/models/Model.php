<?php
/**
 * Base model
 *
 * Defines methods for setting options, retrieving resource loader, creating 
 * and manipulating plugin hooks, and registering and manipulating plugins.
 * 
 * @package    Spindle
 * @subpackage Model
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
abstract class Spindle_Model_Model
{
    /**
     * @var array Class methods
     */
    protected $_classMethods;

    /**
     * @var array Registered hooks
     */
    protected $_hooks = array();

    /**
     * @var array registered plugins
     */
    protected $_plugins = array();

    /**
     * @var My_Controller_Helper_ResourceLoader
     */
    protected $_resourceLoader;

    /**
     * Constructor
     * 
     * @param  array|Zend_Config|null $options 
     * @return void
     */
    public function __construct($options = null)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }

        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set options using setter methods
     * 
     * @param  array $options 
     * @return Spindle_Model_Paste
     */
    public function setOptions(array $options)
    {
        if (null === $this->_classMethods) {
            $this->_classMethods = get_class_methods($this);
        }
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $this->_classMethods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Set resource loader
     * 
     * @param  object $loader 
     * @return Spindle_Model_DbTable_Paste
     */
    public function setResourceLoader($loader)
    {
        if (!is_object($loader)) {
            throw new Exception('Invalid resource loader provided to ' . __CLASS__);
        }
        $this->_resourceLoader = $loader;
        return $this;
    }

    /**
     * Retrieve resource loader
     * 
     * @return object
     */
    public function getResourceLoader()
    {
        if (null === $this->_resourceLoader) {
            $this->_resourceLoader = new My_Controller_Helper_ResourceLoader;
            $this->_resourceLoader->initModule('spindle');
        }
        return $this->_resourceLoader;
    }

    /**
     * Add a plugin hook
     * 
     * @param  string $hook 
     * @return Spindle_Model_Model
     */
    public function addHook($hook)
    {
        $hook = (string) $hook;
        if (!$this->hasHook($hook)) {
            $this->_hooks[] = $hook;
        }
        return $this;
    }

    /**
     * Add multiple hooks
     * 
     * @param  array $hooks 
     * @return Spindle_Model_Model
     */
    public function addHooks(array $hooks)
    {
        foreach ($hooks as $hook) {
            $this->addHook($hook);
        }
        return $this;
    }

    /**
     * Overwrite all hooks
     * 
     * @param  array $hooks 
     * @return Spindle_Model_Model
     */
    public function setHooks(array $hooks)
    {
        $this->clearHooks();
        return $this->addHooks($hooks);
    }

    /**
     * Retrive all hooks
     * 
     * @return array
     */
    public function getHooks()
    {
        return $this->_hooks;
    }

    /**
     * Does the given hook exist?
     * 
     * @param  string $hook 
     * @return bool
     */
    public function hasHook($hook)
    {
        return in_array((string) $hook, $this->_hooks);
    }

    /**
     * Remove a hook
     * 
     * @param  string $hook 
     * @return Spindle_Model_Model
     */
    public function removeHook($hook)
    {
        $hook = (string) $hook;
        if ($this->hasHook($hook)) {
            $index = array_search($hook, $this->_hooks);
            unset($this->_hooks[$index]);
        }
        return $this;
    }

    /**
     * Clear all hooks
     * 
     * @return Spindle_Model_Model
     */
    public function clearHooks()
    {
        $this->_hooks = array();
        return $this;
    }

    /**
     * Add a plugin to a hook
     * 
     * @param  string|object $plugin 
     * @param  array|string|null $hook 
     * @return Spindle_Model_Model
     */
    public function addPlugin($plugin, $hook = null)
    {
        if (is_string($plugin)) {
            $plugin = $this->getResourceLoader()->load(ucfirst($plugin));
        } elseif (!is_object($plugin)) {
            require_once dirname(__FILE__) . '/Exception.php';
            throw new Spindle_Model_Exception('Invalid plugin "' . var_export($plugin, 1) . '" specified');
        }

        if (null === $hook) {
            $hooks = $this->getHooks();
        } elseif (is_array($hook)) {
            $hooks = $hook;
        } elseif (is_string($hook) && $this->hasHook($hook)) {
            $hooks = array($hook);
        } else {
            require_once dirname(__FILE__) . '/Exception.php';
            throw new Spindle_Model_Exception('Invalid hook "' . $hook . '" specified');
        }
        foreach ($this->getHooks() as $hook) {
            if (!isset($this->_plugins[$hook])) {
                $this->_plugins[$hook] = array();
            }
            $pluginName = get_class($plugin);
            $this->_plugins[$hook][$pluginName] = $plugin;
        }
        return $this;
    }

    /**
     * Add multiple plugins at once.
     *
     * Each plugin should be an assoc array with the key "plugin" and 
     * optionally the key "hook".
     * 
     * @param  array $plugins 
     * @return Spindle_Model_Model
     */
    public function addPlugins(array $plugins)
    {
        foreach ($plugins as $spec) {
            if (!is_array($spec)
                || !array_key_exists('plugin', $spec)
            ) {
                require_once dirname(__FILE__) . '/Exception.php';
                throw new Spindle_Model_Exception('Plugins passed to addPlugins must be arrays  with key/value pairs for "plugin" and optionally "hook"');
            }
            $plugin = $spec['plugin'];
            $hook   = null;
            if (!empty($spec['hook'])) {
                $hook = $spec['hook'];
            }
            $this->addPlugin($plugin, $hook);
        }
        return $this;
    }

    /**
     * Overwrite and set plugins
     *
     * See {@link addPlugins()} for format.
     * 
     * @param  array $plugins 
     * @return Spindle_Model_Model
     */
    public function setPlugins(array $plugins)
    {
        $this->clearPlugins();
        return $this->addPlugins();
    }

    /**
     * Return all plugins (optionally for the given hook or hooks)
     * 
     * @param  null|string|array $hook 
     * @return array
     */
    public function getPlugins($hook = null)
    {
        if (null === $hook) {
            return $this->_plugins;
        }

        if (is_array($hook)) {
            $plugins = array();
            foreach ($hook as $h) {
                if (!$this->hasHook($h)) {
                    continue;
                }
                if (isset($this->_plugins[$h])) {
                    $plugins[$h] = $this->_plugins[$h];
                }
            }
            return $plugins;
        }

        if (is_string($hook) && $this->hasHook($hook)) {
            if (isset($this->_plugins[$hook])) {
                return $this->_plugins[$hook];
            }
        }

        return array();
    }

    /**
     * Retrieve a given plugin by hook
     * 
     * @param  string $plugin 
     * @param  string $hook 
     * @return false|object
     */
    public function getPlugin($plugin, $hook)
    {
        $hook = (string) $hook;
        if (!$this->hasHook($hook)) {
            return false;
        }
        $plugin  = ucfirst((string) $plugin);
        $plugins = $this->getPlugins($hook);
        foreach ($plugins as $name => $object)  {
            if ($name == $plugin) {
                 return $object;
            }

            $len = strlen($plugin);
            if (($len < strlen($name))
                && ($plugin == substr($name, -$len)) 
            ) {
                return $object;
            }
        }
        return false;
    }

    /**
     * Does the given hook (or any hook) have the given plugin?
     * 
     * @param  string $plugin 
     * @param  null|string|array $hook 
     * @return bool
     */
    public function hasPlugin($plugin, $hook = null)
    {
        if (null === $hook) {
            $hooks = $this->getHooks();
        } elseif (is_array($hook)) {
            $hooks = $hook;
        } elseif (is_string($hook)) {
            $hooks = array($hook);
        } else {
            require_once dirname(__FILE__) . '/Exception.php';
            throw new Spindle_Model_Exception('Invalid hook "' . $hook . '" specified');
        }

        foreach ($hooks as $hook) {
            if (false !== $this->getPlugin($plugin, $hook)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Remove a plugin by name and optionally hook(s)
     * 
     * @param  string $plugin 
     * @param  null|string|array $hook 
     * @return Spindle_Model_Model
     */
    public function removePlugin($plugin, $hook = null)
    {
        if (null === $hook) {
            $hooks = $this->getHooks();
        } elseif (is_array($hook)) {
            $hooks = $hook;
        } elseif (is_string($hook)) {
            $hooks = array($hook);
        } else {
            require_once dirname(__FILE__) . '/Exception.php';
            throw new Spindle_Model_Exception('Invalid hook "' . $hook . '" specified');
        }

        foreach ($hooks as $hook) {
            if (false !== ($object = $this->getPlugin($plugin, $hook))) {
                $name = get_class($plugin);
                unset($this->_plugins[$hook][$name]);
            }
        }

        return $this;
    }

    /**
     * Clear plugins for a given hook, set of hooks, or all hooks
     * 
     * @param  null|string|array $hook 
     * @return Spindle_Model_Model
     */
    public function clearPlugins($hook = null)
    {
        if (null === $hook) {
            $hooks = $this->getHooks();
        } elseif (is_array($hook)) {
            $hooks = $hook;
        } elseif (is_string($hook)) {
            $hooks = array($hook);
        } else {
            require_once dirname(__FILE__) . '/Exception.php';
            throw new Spindle_Model_Exception('Invalid hook "' . $hook . '" specified');
        }

        foreach ($hooks as $hook) {
            if (isset($this->_plugins[$hook])) {
                unset($this->_plugins[$hook]);
            }
        }

        return $this;
    }

    /**
     * Call a plugin hook
     * 
     * @param  string $hook 
     * @param  array $args 
     * @return void
     */
    public function callHook($hook, array $args)
    {
        if (!$this->hasHook($hook)) {
            return;
        }

        $plugins = $this->getPlugins($hook);
        foreach ($plugins as $plugin) {
            call_user_func_array(array($plugin, $hook), $args);
        }
    }
}
