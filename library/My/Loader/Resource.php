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
class My_Loader_Resource
{
    /**
     * @var Zend_Loader_PluginLoader
     */
    protected $_loader = array(
        'dbtable' => null,
        'form'    => null,
        'model'   => null,
        'plugin'  => null,
        'service' => null,
    );

    /**
     * @var array Object registry
     */
    protected $_objects = array(
        'dbtable' => array(),
        'form'    => array(),
        'model'   => array(),
        'plugin'  => array(),
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
            case 'plugin':
                if (null === $this->_loader['plugin']) {
                    $this->_loader['plugin'] = new Zend_Loader_PluginLoader(array(
                        'Controller_Plugin' => APPLICATION_PATH . '/plugins',
                    ));
                }
                $loader = $this->_loader['plugin'];
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
     * Retrieve all resource loaders
     * 
     * @return array
     */
    public function getLoaders()
    {
        $loaders = array();
        foreach ($this->_loader as $type => $loader) {
            if (null === $loader) {
                $loader = $this->getLoader($type);
            }
            $loaders[$type] = $loader;
        }
        return $loaders;
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
     * Load a front controller plugin
     * 
     * @param  string $plugin 
     * @return Zend_Controller_Plugin_Abstract
     */
    public function getPlugin($plugin)
    {
        return $this->_loadResource($plugin, 'plugin');
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
}
