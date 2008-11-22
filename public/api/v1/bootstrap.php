<?php
defined('APPLICATION_PATH') 
    or define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../../application'));
defined('APPLICATION_ENV') or define('APPLICATION_ENV', 'development');
$paths     = array(
    APPLICATION_PATH . '/models',
    realpath(APPLICATION_PATH . '/../library'),
    '.', 
);
set_include_path(implode(PATH_SEPARATOR, $paths));
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

$plugin  = new My_Plugin_Initialize(APPLICATION_ENV);
$request = new Zend_Controller_Request_Http();
$baseUrl = $request->getBaseUrl();
$baseUrl = substr($baseUrl, 0, strpos($baseUrl, '/api/v1/'));

$plugin->setRequest($request);
Zend_Registry::set('init', $plugin);
Zend_Registry::set('baseUrl', $baseUrl);
