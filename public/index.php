<?php
defined('APPLICATION_PATH') 
    or define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
$paths     = array(
    APPLICATION_PATH . '/models',
    realpath(APPLICATION_PATH . '/../library'),
    '.', 
);
set_include_path(implode(PATH_SEPARATOR, $paths));
require_once 'My/Loader/Autoloader.php';
$autoloader = My_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('My');

include dirname(__FILE__) . '/../application/bootstrap.php';

Zend_Controller_Front::getInstance()->dispatch();
