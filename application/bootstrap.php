<?php
defined('APPLICATION_PATH') 
    or define('APPLICATION_PATH', realpath(dirname(__FILE__)));
defined('APPLICATION_ENV') or define('APPLICATION_ENV', 'development');

$front = Zend_Controller_Front::getInstance();
$front->registerPlugin(new My_Plugin_Initialize(APPLICATION_ENV));
