<?php
/**
 * Resource loader action helper
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
    protected $_currentModule;
    protected $_loaders  = array();

    /**
     * Initialize resource loader
     * 
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Proxy to resource loader methods
     * 
     * @param mixed $method 
     * @param mixed $args 
     * @return void
     */
    public function __call($method, $args)
    {
        $loader = $this->getResourceLoader();
        return call_user_func_array(array($loader, $method), $args);
    }

    public function setCurrentModule($module)
    {
        $this->_currentModule = $module;
        return $this;
    }

    public function getCurrentModule()
    {
        return $this->_currentModule;
    }

    public function addResourceLoader($module, $loader)
    {
        $this->_loaders[$module] = $loader;
        return $this;
    }

    public function hasResourceLoader($module)
    {
        return isset($this->_loaders[$module]);
    }

    public function getResourceLoader($module = null)
    {
        if (empty($module)) {
            $module = $this->getCurrentModule();
            if (empty($module)) {
                throw new My_Exception("Cannot retrieve resource loader; no currently selected module");
            }
        }
        if (!$this->hasResourceLoader($module)) {
            throw new My_Exception("No resource loader registered for $module");
        }
        return $this->_loaders[$module];
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

        $module = ucfirst($module);
        if (!$this->hasResourceLoader($module)) {
            $resourceLoader = new My_Loader_Autoloader_Resource(array(
                'prefix'   => $module,
                'basePath' => $dir,
            ));
            $this->addResourceLoader($module, $resourceLoader);
        }

        $this->setCurrentModule($module);
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
        $loader = $this->getResourceLoader();
        return $loader->load($resource, $type);
    }
}
