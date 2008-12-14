<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$bootstrap = Zend_Registry::get('bootstrap');
$request   = $bootstrap->getRequest();
if ($request->isGet()) {
    header('HTTP/1.0 501 Not Supported');
    echo "<h1>501 - Not Supported</h1>";
    exit;
}

$bootstrap->initDb();

$loader   = new My_Controller_Helper_ResourceLoader;
$loader->initModule('spindle');

$paste = $loader->getService('Paste');

$server = new Zend_XmlRpc_Server();
$server->setClass($paste);
echo $server->handle();
