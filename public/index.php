<?php
defined('APPLICATION_PATH') 
    or define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
defined('APPLICATION_ENV') 
    or define('APPLICATION_ENV', 'development');

require_once dirname(__FILE__) . '/../library/My/Application.php';
$app = new My_Application(APPLICATION_ENV, array(
    'autoloaderNamespaces' => array(
        'Phly',
    ),
    'bootstrap' => APPLICATION_PATH . '/Bootstrap.php',
));
$app->bootstrap();

Zend_Controller_Front::getInstance()->dispatch();
