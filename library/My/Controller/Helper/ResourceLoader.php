<?php
/**
 * Resource loader
 * 
 * @uses       Zend_Controller_Action_Helper_Abstract
 * @package    My
 * @subpackage Controller
 * @copyright  Copyright (C) 2008 - Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_Controller_Helper_ResourceLoader extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var Zend_Loader_PluginLoader
     */
    protected $_loader = array(
        'dbtable' => null,
        'form'    => null,
        'model'   => null,
        'service' => null,
    );

    /**
     * @var array Valid loader methods
     */
    protected $_loaderMethods;

    /**
     * @var array Object registry
     */
    protected $_objects = array(
        'dbtable' => array(),
        'form'    => array(),
        'model'   => array(),
        'service' => array(),
    );

    /**
     * Initialize resource loaders
     * 
     * @return void
     */
    public function __construct()
    {
        foreach (array_keys($this->_loader) as $type) {
            $this->getLoader($type);
        }
    }

    /**
     * Initialize paths for current module
     * 
     * @return void
     */
    public function init()
    {
        if (!$this->getActionController()) {
            return;
        }

        $module = $this->getRequest()->getModuleName();
        $dir    = $this->getFrontController()->getModuleDirectory($module);
        $this->initModule($module, $dir);
    }

    /**
     * Initialize prefix paths for a given module, if necessary
     * 
     * @param  string $module 
     * @param  string|null $dir 
     * @return void
     */
    public function initModule($module, $dir = null)
    {
        if (null === $dir) {
            $dir = APPLICATION_PATH . '/modules/' . $module;
        }

        foreach ($this->_loader as $type => $loader) {
            $prefix = ucfirst($module) . '_';
            switch ($type) {
                case 'dbtable':
                    $prefix .= 'Model_DbTable';
                    $path    = '/models/DbTable';
                    break;
                case 'model':
                    $prefix .= 'Model';
                    $path    = '/models';
                    break;
                case 'form':
                case 'service':
                    $prefix .= 'Model_' . ucfirst($type);
                    $path    = '/models/' . ucfirst($type);
                    break;
            }
            if (!$loader->getPaths($prefix)) {
                $loader->addPrefixPath($prefix, $dir . $path);
            }
        }
    }

    /**
     * Retrieve plugin loader
     * 
     * @param  string $type 
     * @return Zend_Loader_PluginLoader
     * @throws Exception for invalid $type
     */
    public function getLoader($type)
    {
        switch (strtolower($type)) {
            case 'dbtable':
                if (null === $this->_loader['dbtable']) {
                    $this->_loader['dbtable'] = new Zend_Loader_PluginLoader(array(
                        'Model_DbTable' => APPLICATION_PATH . '/models/DbTable',
                    ));
                }
                $loader = $this->_loader['dbtable'];
                break;
            case 'form':
                if (null === $this->_loader['form']) {
                    $this->_loader['form'] = new Zend_Loader_PluginLoader(array(
                        'Model_Form' => APPLICATION_PATH . '/models/Form',
                    ));
                }
                $loader = $this->_loader['form'];
                break;
            case 'model':
                if (null === $this->_loader['model']) {
                    $this->_loader['model'] = new Zend_Loader_PluginLoader(array(
                        'Model' => APPLICATION_PATH . '/models',
                    ));
                }
                $loader = $this->_loader['model'];
                break;
            case 'service':
                if (null === $this->_loader['service']) {
                    $this->_loader['service'] = new Zend_Loader_PluginLoader(array(
                        'Model_Service' => APPLICATION_PATH . '/models/Service',
                    ));
                }
                $loader = $this->_loader['service'];
                break;
            default:
                throw new Exception("Invalid resource type specified");
        }

        return $loader;
    }

    /**
     * Load a given resource by type
     * 
     * @param  string $resource 
     * @param  string $type 
     * @return object
     */
    protected function _loadResource($resource, $type)
    {
        if (empty($this->_objects[$type][$resource])) {
            $class = $this->getLoader($type)->load($resource);
            $this->_objects[$type][$resource] = new $class;
        }
        return $this->_objects[$type][$resource];
    }

    /**
     * Load a dbtable class and return an instance
     * 
     * @param  string $table 
     * @return Zend_Db_Table_Abstract
     */
    public function getDbtable($table)
    {
        return $this->_loadResource($table, 'dbtable');
    }

    /**
     * Load a form class and return an instance
     * 
     * @param  string $form 
     * @return Zend_Form
     */
    public function getForm($form)
    {
        return $this->_loadResource($form, 'form');
    }

    /**
     * Load a model class and return an object instance
     * 
     * @param  string $model 
     * @return object
     */
    public function getModel($model)
    {
        return $this->_loadResource($model, 'model');
    }

    /**
     * Load a service class and return an object instance
     * 
     * @param  string $service 
     * @return object
     */
    public function getService($service)
    {
        return $this->_loadResource($service, 'service');
    }

    /**
     * Proxy to a resource loader method
     * 
     * @param  string $resource
     * @param  string $type
     * @return object
     */
    public function direct($resource, $type = 'model')
    {
        if (null === $this->_loaderMethods) {
            $this->_loaderMethods = get_class_methods($this);
        }

        $method = 'get' . ucfirst(strtolower($type));
        if (!in_array($method, $this->_loaderMethods)) {
            throw new Exception('Invalid resource type specified; must be one of (' . implode(', ', array_keys($this->_loader)) . ')');
        }

        return $this->_loadResource($resource, $type);
    }
}
