<?php
/**
 * Bootstrap interface
 * 
 * @package    My
 * @subpackage Module
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net>
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
interface My_Module_Bootstrap
{
    public function setAppBootstrap($bootstrap);
    public function getAppBootstrap();
    public function bootstrap();
}
