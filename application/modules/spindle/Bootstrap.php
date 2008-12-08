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
        $this->initConfig()
             ->checkJsEnabled()
             ->initPlugins();
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
            if (Zend_Registry::isRegistered('ResourceLoader')) {
                $this->_resourceLoader = Zend_Registry::get('ResourceLoader');
            } else {
                $this->_resourceLoader = new My_Loader_Resource;
            }
            $this->_resourceLoader->getLoader('plugin')->addPrefixPath(
                'Spindle_Plugin',
                dirname(__FILE__) . '/plugins'
            );
        }
        return $this->_resourceLoader;
    }
}
