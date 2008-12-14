<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$bootstrap = Zend_Registry::get('bootstrap');
$bootstrap->initDb();

$loader = new My_Controller_Helper_ResourceLoader;
$loader->initModule('spindle');

$request  = $bootstrap->request;
$model    = $loader->getModel('Paste');
$dojoData = new Zend_Dojo_Data('id', $model->fetchActive($request->getQuery()), 'id');
$dojoData->setMetadata('count', $model->fetchActiveCount());

header('Content-Type: application/json');
echo $dojoData;
