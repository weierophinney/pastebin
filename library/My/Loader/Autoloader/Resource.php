<?php
/**
 * Resource loader
 * 
 * @uses       Zend_Controller_Action_Helper_Abstract
 * @package    My_Loader
 * @subpackage Autoloader
 * @copyright  Copyright (C) 2008 - Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_Loader_Autoloader_Resource implements My_Loader_Autoloader_Interface
{
    protected $_basePath;
    protected $_components = array();
    protected $_defaultResourceType;
    protected $_prefix;
    protected $_resourceTypes = array();

    public function __construct($options)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        if (!is_array($options)) {
            throw new My_Loader_Exception('Options must be passed to resource loader constructor');
        }

        $this->setOptions($options);

        if ((null === $this->getPrefix())
            || (null === $this->getBasePath())
        ) {
            throw new My_Loader_Exception('Resource loader requires both a prefix and a base path for initialization');
        }

        $this->initDefaultResourceTypes();
        My_Loader_Autoloader::unshiftAutoloader($this);
    }

    public function initDefaultResourceTypes()
    {
        $basePath = $this->getBasePath();
        $this->addResourceTypes(array(
            'dbtable' => array(
                'prefix' => 'Model_DbTable',
                'path'   => 'models/DbTable',
            ),
            'Form'    => array(
                'prefix' => 'Model_Form',
                'path'   => 'models/Form',
            ),
            'Model'   => array(
                'prefix' => 'Model',
                'path'   => 'models',
            ),
            'Plugin'  => array(
                'prefix' => 'Plugin',
                'path'   => 'plugins',
            ),
            'Service' => array(
                'prefix' => 'Model_Service',
                'path'   => 'models/Service',
            ),
        ));
        $this->setDefaultResourceType('model');
    }

    public function __call($method, $args)
    {
        if ('get' == substr($method, 0, 3)) {
            $type  = strtolower(substr($method, 3));
            if (!$this->hasResourceType($type)) {
                throw new My_Loader_Exception("Invalid resource type $type; cannot load resource");
            }
            if (empty($args)) {
                throw new My_Loader_Exception("Cannot load resources; no resource specified");
            }
            $resource = array_shift($args);
            return $this->load($resource, $type);
        }

        throw new My_Loader_Exception("Method '$method' is not supported");
    }

    public function autoload($class)
    {
        $segments = explode('_', $class);
        $prefix   = array_shift($segments);
        if ($prefix != $this->getPrefix()) {
            // wrong prefix? we're done'
            return false;
        }
        if (count($segments) < 2) {
            // assumes all resources have a namespace and component, minimum
            return false;
        }

        $final     = array_pop($segments);
        $component = $prefix;
        $lastMatch = false;
        do {
            $segment    = array_shift($segments);
            $component .= '_' . $segment;
            if (isset($this->_components[$component])) {
                $lastMatch = $component;
            }
        } while (count($segments));

        if (!$lastMatch) {
            return false;
        }

        $final = substr($class, strlen($lastMatch));
        $path = $this->_components[$lastMatch];
        return include $path . '/' . str_replace('_', '/', $final) . '.php';
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
        return $this;
    }

    public function setPrefix($prefix)
    {
        $this->_prefix = rtrim((string) $prefix, '_');
        return $this;
    }

    public function getPrefix()
    {
        return $this->_prefix;
    }

    public function setBasePath($path)
    {
        $this->_basePath = (string) $path;
        return $this;
    }
    
    public function getBasePath()
    {
        return $this->_basePath;
    }

    public function addResourceType($type, $path, $prefix = null)
    {
        $type = strtolower($type);
        if (!isset($this->_resourceTypes[$type])) {
            if (null === $prefix) {
                throw new My_Loader_Exception('Initial definition of a resource type must include a prefix');
            }
            $prefix = trim($prefix, '_');
            $this->_resourceTypes[$type] = array(
                'prefix' => $this->getPrefix() . '_' . $prefix,
            );
        }
        if (!is_string($path)) {
            throw new My_Loader_Exception('Invalid path specification provided; must be string');
        }
        $this->_resourceTypes[$type]['path'] = $this->getBasePath() . '/' . $path;

        $component = $this->_resourceTypes[$type]['prefix'];
        $this->_components[$component] = $this->_resourceTypes[$type]['path'];
        return $this;
    }

    public function addResourceTypes(array $types)
    {
        foreach ($types as $type => $spec) {
            if (!is_array($spec)) {
                throw new My_Loader_Exception('addResourceTypes() expects an array of arrays');
            }
            if (!isset($spec['path'])) {
                throw new My_Loader_Exception('addResourceTypes() expects each array to include a paths element');
            }
            $paths  = $spec['path'];
            $prefix = null;
            if (isset($spec['prefix'])) {
                $prefix = $spec['prefix'];
            }
            $this->addResourceType($type, $paths, $prefix);
        }
        return $this;
    }

    public function setResourceTypes(array $types)
    {
        $this->clearResourceTypes();
        return $this->addResourceTypes($types);
    }

    public function getResourceTypes()
    {
        return $this->_resourceTypes;
    }

    public function hasResourceType($type)
    {
        return isset($this->_resourceTypes[$type]);
    }

    public function removeResourceType($type)
    {
        if ($this->hasResourceType($type)) {
            $prefix = $this->_resourceTypes[$type]['prefix'];
            unset($this->_components[$prefix]);
            unset($this->_resourceTypes[$type]);
        }
        return $this;
    }

    public function clearResourceTypes()
    {
        $this->_resourceTypes = array();
        $this->_components    = array();
        $this->initDefaultResourceTypes();
        return $this;
    }

    public function setDefaultResourceType($type)
    {
        if ($this->hasResourceType($type)) {
            $this->_defaultResourceType = $type;
        }
        return $this;
    }

    public function getDefaultResourceType()
    {
        return $this->_defaultResourceType;
    }

    public function load($resource, $type = null)
    {
        if (null === $type) {
            $type = $this->getDefaultResourceType();
            if (empty($type)) {
                throw new My_Loader_Exception('No resource type specified');
            }
        }
        if (!$this->hasResourceType($type)) {
            throw new My_Loader_Exception('Invalid resource type specified');
        }
        $prefix = $this->_resourceTypes[$type]['prefix'];
        $class  = $prefix . '_' . ucfirst($resource);
        if (!isset($this->_resources[$class])) {
            $this->_resources[$class] = new $class;
        }
        return $this->_resources[$class];
    }
}
