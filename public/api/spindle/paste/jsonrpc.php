<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$plugin  = Zend_Registry::get('init');
$request = $plugin->getRequest();
$plugin->initDb();

$loader   = new My_Controller_Helper_ResourceLoader;
$loader->initModule('spindle');

$paste = $loader->getService('Paste');

$server = new Zend_Json_Server();
$server->setClass($paste);

if ($request->isGet()) {
    $server->setTarget($request->getBaseUrl() . '/jsonrpc')
           ->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);

    // Grab the SMD
    $smd = $server->getServiceMap();

    // Cache the SMD
    if (('production' == APPLICATION_ENV) && is_writeable(dirname(__FILE__))) {
        file_put_contents(dirname(__FILE__) . '/content/jsonrpc.smd', $smd);
    }

    // Return the SMD to the client
    header('Content-Type: application/json');
    echo $smd;
    return;
}

$server->handle();
