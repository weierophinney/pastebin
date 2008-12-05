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
     * Spindle-specific bootstrapping
     * 
     * @return void
     */
    public function bootstrap()
    {
        $this->initConfig()
             ->checkJsEnabled();
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
}
