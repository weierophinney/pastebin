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
class Spindle_Bootstrap extends My_Module_Base
{
    /**
     * @var My_Loader_Resource
     */
    protected $_resourceLoader;

    /**
     * Spindle-specific bootstrapping
     * 
     * @return void
     */
    public function bootstrap()
    {
        $this->moduleDir = dirname(__FILE__);
        $this->log = new Zend_Log(new Zend_Log_Writer_Stream('/tmp/pubsub.log'));

        Phly_PubSub::subscribe("Spindle_Model_User::save::start", $this, 'log');
        Phly_PubSub::subscribe("Spindle_Model_User::save::end", $this, 'log');

        $this->initAutoloader()
             ->initConfig()
             ->checkJsEnabled()
             ->initPlugins();
    }

    public function log()
    {
        $args = func_get_args();
        $this->log->info(var_export($args, 1));
    }

    public function initAutoloader()
    {
        $resourceLoader = new My_Loader_Resource(array(
            'prefix'   => 'Spindle',
            'basePath' => realpath(dirname(__FILE__)),
        ));
        $resourceLoader->addResourceType('validator', 'models/Validate', 'Model_Validate');
        $resourceLoader = Zend_Controller_Action_HelperBroker::getStaticHelper('ResourceLoader');
        $resourceLoader->initModule('spindle', realpath(dirname(__FILE__)));
        $this->_resourceLoader = $resourceLoader;
        return $this;
    }

    /**
     * Initialize configuration
     * 
     * @return Spindle_Bootstrap
     */
    public function initConfig()
    {
        $appBootstrap = $this->getAppBootstrap();
        $configMaster = $appBootstrap->config;
        $config       = new Zend_Config_Ini(
            dirname(__FILE__). '/config/spindle.ini', 
            $appBootstrap->env
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
        $loader = $this->_getResourceLoader();
        $front  = $this->getAppBootstrap()->front;

        $front->registerPlugin($loader->getPlugin('Auth'));
        return $this;
    }

    /**
     * Check if javascript is enabled
     * 
     * @return Spindle_Bootstrap
     */
    public function checkJsEnabled()
    {
        $appBootstrap = $this->getAppBootstrap();
        $request      = $appBootstrap->getRequest();
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

    /**
     * Retrieve resource loader
     * 
     * @return My_Loader_Resource
     */
    protected function _getResourceLoader()
    {
        if (null === $this->_resourceLoader) {
            $this->initAutoloader();
        }
        return $this->_resourceLoader;
    }
}
