<?php
defined('APPLICATION_PATH') 
    or define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
$paths     = array(
    '.', 
    APPLICATION_PATH . '/models',
    realpath(APPLICATION_PATH . '/../library'),
);
ini_set('include_path', implode(PATH_SEPARATOR, $paths));
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

include dirname(__FILE__) . '/../application/bootstrap.php';

Zend_Controller_Front::getInstance()->dispatch();
