<?php
/**
 * Spindle_Bootstrap 
 * 
 * @uses       My_Module_Base
 * @package    Spindle
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Bootstrap extends My_Application_Bootstrap_Module
{
    public function init()
    {
        $this->moduleDir = dirname(__FILE__);
    }

    public function getResourceLoader()
    {
        if (null === $this->_resourceLoader) {
            $resourceLoader = new My_Loader_Resource(array(
                'prefix'   => 'Spindle',
                'basePath' => realpath(dirname(__FILE__)),
            ));
            $resourceLoader->addResourceType('validator', 'models/Validate', 'Model_Validate')
                           ->addResourceType('aclrole', 'models/Acl/Role', 'Model_Acl_Role')
                           ->addResourceType('aclresource', 'models/Acl/Resource', 'Model_Acl_Resource');
            $this->setResourceLoader($resourceLoader);
        }
        return $this->_resourceLoader;
    }

    public function initAutoloader()
    {
        $autoloader = $this->getResourceLoader();
        $helper = Zend_Controller_Action_HelperBroker::getStaticHelper('ResourceLoader');
        $helper->addResourceLoader('spindle', $autoloader);
        return $this;
    }

    /**
     * Initialize configuration
     * 
     * @return Spindle_Bootstrap
     */
    public function initConfig()
    {
        $appBootstrap = $this->getApplication();
        $configMaster = $appBootstrap->config;
        $config       = new Zend_Config_Ini(
            dirname(__FILE__). '/config/spindle.ini', 
            $appBootstrap->getEnvironment()
        );
        $configMaster->merge($config);
        return $this;
    }

    /**
     * Initialize plugins
     * 
     * @return Spindle_Bootstrap
     */
    public function initPlugins()
    {
        $loader = $this->getResourceLoader();
        $front  = $this->getApplication()->front;

        $front->registerPlugin($loader->getPlugin('Auth'));
        return $this;
    }

    /**
     * Check if javascript is enabled
     * 
     * @return Spindle_Bootstrap
     */
    public function initJsEnabled()
    {
        $appBootstrap = $this->getApplication();
        $request      = $appBootstrap->request;
        if ($request->getParam('jsEnabled', false)) {
            setcookie('spindleJsEnabled', 1, strtotime('+30 days'));
            $request->setParam('jsEnabled', true);
        } elseif ($request->getCookie('spindleJsEnabled', false)) {
            $request->setParam('jsEnabled', true);
        } else {
            $request->setParam('jsEnabled', false);
        }
        return $this;
    }
}
