<?php
abstract class My_Application_Bootstrap_Base implements My_Application_Bootstrap
{
    protected $_application;
    protected $_environment;
    protected $_initMethods = array();
    protected $_options = array();
    protected $_run = array();

    public function __construct($application)
    {
        if (($application instanceof My_Application) 
            || ($application instanceof My_Application_Bootstrap)
        ) {
            $this->_application = $application;
        } else {
            throw new My_Application_Exception('Invalid application provided to bootstrap constructor');
        }

        $options = $application->getOptions();
        $this->setOptions($options);

        foreach (get_class_methods($this) as $method) {
            if (4 < strlen($method) && ('init' == substr($method, 0, 4))) {
                $this->_initMethods[] = strtolower($method);
            }
        }

        $this->init();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        $this->_options = $options;
        return $this;
    }

    public function getOptions()
    {
        return $this->_options;
    }

    public function init()
    {
    }

    public function getApplication()
    {
        return $this->_application;
    }

    public function getEnvironment()
    {
        return $this->getApplication()->getEnvironment();
    }

    public function runInitializer($method)
    {
        if ('init' != substr($method, 0, 4)) {
            $method = 'init' . $method;
        }
        $method = strtolower($method);
        if (!in_array($method, $this->_run) && in_array($method, $this->_initMethods)) {
            $this->$method();
            $this->_markRun($method);
        }
    }

    public function bootstrap()
    {
        foreach ($this->_initMethods as $method) {
            $this->runInitializer($method);
        }
    }

    protected function _markRun($method)
    {
        if (!in_array($method, $this->_run)) {
            $this->_run[] = $method;
        }
    }
}
