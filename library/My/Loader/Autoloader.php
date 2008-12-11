<?php
require_once 'Zend/Loader.php';

class My_Loader_Autoloader
{
    protected static $_instance;

    protected $_autoloaders = array();
    protected $_fallbackAutoloader = false;
    protected $_namespaces = array('Zend' => true);
    protected $_suppressNotFoundWarnings = true;

    protected function __construct()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public function setAutoloaders(array $autoloaders)
    {
        $this->_autoloaders = $autoloaders;
        return $this;
    }

    public function getAutoloaders()
    {
        return $this->_autoloaders;
    }

    public function registerNamespace($namespace)
    {
        if (is_string($namespace)) {
            $namespace = (array) $namespace;
        } elseif (!is_array($namespace)) {
            throw new Zend_Loader_Exception('Invalid namespace provided');
        }

        foreach ($namespace as $ns) {
            if (!isset($this->_namespaces[$ns])) {
                $this->_namespaces[$ns] = true;
            }
        }
        return $this;
    }

    public function unregisterNamespace($namespace)
    {
        if (is_string($namespace)) {
            $namespace = (array) $namespace;
        } elseif (!is_array($namespace)) {
            throw new Zend_Loader_Exception('Invalid namespace provided');
        }

        foreach ($namespace as $ns) {
            if (isset($this->_namespaces[$ns])) {
                unset($this->_namespaces[$ns]);
            }
        }
        return $this;
    }

    public function getRegisteredNamespaces()
    {
        return array_keys($this->_namespaces);
    }

    public function suppressNotFoundWarnings($flag = null)
    {
        if (null === $flag) {
            return $this->_suppressNotFoundWarnings;
        }
        $this->_suppressNotFoundWarnings = (bool) $flag;
        return $this;
    }

    public function setFallbackAutoloader($flag)
    {
        $this->_fallbackAutoloader = (bool) $flag;
        return $this;
    }

    public function isFallbackAutoloader()
    {
        return $this->_fallbackAutoloader;
    }

    public static function autoload($class)
    {
        $self = self::getInstance();

        foreach ($self->getAutoloaders() as $autoloader) {
            if ($autoloader instanceof My_Loader_Autoloader_Interface) {
                if ($autoloader->autoload($class)) {
                    return true;
                }
            } elseif (is_string($autoloader)) {
                if ($autoloader($class)) {
                    return true;
                }
            } elseif (is_array($autoloader)) {
                $object = array_shift($autoloader);
                $method = array_shift($autoloader);
                if (call_user_func(array($object, $method), $class)) {
                    return true;
                }
            }
        }

        $segments = explode('_', $class);
        if (in_array($segments[0], $self->getRegisteredNamespaces()) 
            || $self->isFallbackAutoloader()
        ) {
            if ($self->suppressNotFoundWarnings()) {
                return @Zend_Loader::loadClass($class);
            }
            return Zend_Loader::loadClass($class);
        }

        return false;
    }

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function unshiftAutoloader($callback)
    {
        $self = self::getInstance();
        $autoloaders = $self->getAutoloaders();
        array_unshift($autoloaders, $callback);
        $self->setAutoloaders($autoloaders);
    }

    public static function pushAutoloader($callback)
    {
        $self = self::getInstance();
        $autoloaders = $self->getAutoloaders();
        array_push($autoloaders, $callback);
        $self->setAutoloaders($autoloaders);
    }

    public static function removeAutoloader($callback)
    {
        $self = self::getInstance();
        $autoloaders = $self->getAutoloaders();
        if (false !== ($index = array_search($autoloaders, $callback, true))) {
            unset($autoloaders[$index]);
            $self->setAutoloaders($autoloaders);
        }
    }
}
