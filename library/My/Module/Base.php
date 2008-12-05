<?php
/**
 * Base bootstrap class
 * 
 * @uses       My_Module_Bootstrap
 * @package    My
 * @subpackage Module
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net>
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
abstract class My_Module_Base implements My_Module_Bootstrap
{
    /**
     * @var object Application bootstrap object
     */
    protected $_appBootstrap;

    /**
     * Set application bootstrap object
     * 
     * @param  object $bootstrap 
     * @return My_Module_Base
     */
    public function setAppBootstrap($bootstrap)
    {
        $this->_appBootstrap = $bootstrap;
        return $this;
    }

    /**
     * Retrieve application bootstrap object
     * 
     * @return object
     */
    public function getAppBootstrap()
    {
        return $this->_appBootstrap;
    }
}
