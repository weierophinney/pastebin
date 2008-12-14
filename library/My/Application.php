<?php
class My_Application
{
    protected $_autoloader;
    protected $_bootstrap;
    protected $_env;
    protected $_options = array();

    final public function __construct($env, $options)
    {
        $this->_setupMinimalIncludePath();
        $this->_env = $env;

        require_once 'My/Loader/Autoloader.php';
        $this->_autoloader = My_Loader_Autoloader::getInstance();

        if (is_string($options)) {
            $options = $this->_loadConfig($options);
        } elseif ($options instanceof Zend_Config) {
            $options = $options->toArray();
        } elseif (!is_array($options)) {
            require_once 'My/Application/Exception.php';
            throw new My_Application_Exception('Invalid options provided; must be location of config file, a config object, or an array');
        }
        $this->setOptions($options);
    }

    public function getEnvironment()
    {
        return $this->_env;
    }

    public function getAutoloader()
    {
        return $this->_autoloader;
    }

    final public function setOptions(array $options)
    {
        $options = array_change_key_case($options, CASE_LOWER);
        if (!empty($options['phpsettings'])) {
            $this->setPhpSettings($options['phpsettings']);
        }
        if (!empty($options['includepaths'])) {
            $this->setIncludePaths($options['includepaths']);
        }
        if (!empty($options['autoloadernamespaces'])) {
            $this->setAutoloaderNamespaces($options['autoloadernamespaces']);
        }
        if (!empty($options['bootstrap'])) {
            $bootstrap = $options['bootstrap'];
            if (is_string($bootstrap)) {
                $this->setBootstrap($bootstrap);
            } elseif (is_array($bootstrap)) {
                if (empty($bootstrap['path'])) {
                    throw new My_Application_Exception('No bootstrap path provided');
                }
                $path  = $bootstrap['path'];
                $class = null;
                if (empty($bootstrap['class'])) {
                    $class = $bootstrap['class'];
                }
                $this->setBootstrap($path, $class);

            } else {
                throw new My_Application_Exception('Invalid bootstrap information provided');
            }
        }
        $this->_options = $options;
    }

    final public function getOptions()
    {
        return $this->_options;
    }

    final public function setPhpSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            ini_set($key, $value);
        }
        return $this;
    }

    final public function setIncludePaths(array $paths)
    {
        $path = implode(PATH_SEPARATOR, $paths);
        set_include_path($path . PATH_SEPARATOR . get_include_path());
        return $this;
    }

    final public function setAutoloaderNamespaces(array $namespaces)
    {
        $autoloader = $this->getAutoloader();
        foreach ($namespaces as $namespace) {
            $autoloader->registerNamespace($namespace);
        }
    }

    final public function setBootstrap($path, $class = null)
    {
        if (empty($class)) {
            $class = 'Bootstrap';
        }
        require_once $path;
        $this->_bootstrap = new $class($this);
    }

    public function getBootstrap()
    {
        return $this->_bootstrap;
    }

    public function bootstrap()
    {
        $this->getBootstrap()->bootstrap();
    }

    private function _setupMinimalIncludePath()
    {
        $includePath = get_include_path();
        $paths = explode(PATH_SEPARATOR, $includePath);
        $myApplicationPath = realpath(dirname(__FILE__) . '/../');

        $found = false;
        foreach ($paths as $path) {
            if (realpath($path) == $myApplicationPath) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            array_unshift($paths, $myApplicationPath);
        }
        set_include_path(implode(PATH_SEPARATOR, $paths));
    }

    private function _loadConfig($file)
    {
        $env    = $this->getEnvironment();
        $suffix = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        switch ($suffix) {
            case 'ini':
                require_once 'Zend/Config/Ini.php';
                $config = new Zend_Config_Ini($suffix, $env);
                break;
            case 'xml':
                require_once 'Zend/Config/Xml.php';
                $config = new Zend_Config_Xml($suffix, $env);
                break;
            default:
                require_once 'My/Application/Exception.php';
                throw new My_Application_Exception('Invalid configuration file provided; unknown config type');
        }
        return $config->toArray();
    }
}
