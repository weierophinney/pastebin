<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$plugin  = Zend_Registry::get('init');
$request = $plugin->getRequest();
if ($request->isGet()) {
    header('HTTP/1.0 501 Not Supported');
    echo "<h1>501 - Not Supported</h1>";
    exit;
}

$plugin->initDb();

$server = new Zend_XmlRpc_Server();
$server->setClass('Paste_Service');
echo $server->handle();
