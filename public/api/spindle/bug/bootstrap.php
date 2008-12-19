<?php
defined('APPLICATION_PATH') 
    or define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../../../application'));
defined('APPLICATION_ENV') 
    or define('APPLICATION_ENV', 'development');

require_once APPLICATION_PATH . '/../library/My/Application.php';
$app = new My_Application(APPLICATION_ENV, array(
    'autoloaderNamespaces' => array(
        'Phly',
    ),
    'bootstrap' => APPLICATION_PATH . '/Bootstrap.php',
));
$bootstrap = $app->getBootstrap();
$bootstrap->initRequest();

$request = $bootstrap->request;
$baseUrl = $request->getBaseUrl();
$baseUrl = substr($baseUrl, 0, strpos($baseUrl, '/api/spindle/bug/'));

Zend_Registry::set('bootstrap', $bootstrap);
Zend_Registry::set('baseUrl', $baseUrl);
