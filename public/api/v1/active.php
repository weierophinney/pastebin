<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$plugin   = Zend_Registry::get('init');
$plugin->initDb();

$request  = $plugin->getRequest();
$model    = new Paste;
$dojoData = new Zend_Dojo_Data('id', $model->fetchActive($request->getQuery()), 'id');
$dojoData->setMetadata('count', $model->fetchActiveCount());

header('Content-Type: application/json');
echo $dojoData;
