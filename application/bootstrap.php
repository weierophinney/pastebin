<?php
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));
defined('APPLICATION_ENV') or define('APPLICATION_ENV', 'development');

if (defined('BOOTSTRAP')) {
    require_once 'Zend/Loader.php';
    Zend_Loader::registerAutoload();
}

$front = Zend_Controller_Front::getInstance();
$front->registerPlugin(new My_Plugin_Initialize(APPLICATION_ENV))
      ->addControllerDirectory($base . '/application/controllers');
