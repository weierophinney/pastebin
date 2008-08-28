<?php
if (isset($bootstrap) && $bootstrap) {
    require_once 'Zend/Loader.php';
    Zend_Loader::registerAutoload();
}

$front = Zend_Controller_Front::getInstance();
$front->registerPlugin(new My_Plugin_Initialize($base, 'development'))
      ->addControllerDirectory($base . '/application/controllers');
