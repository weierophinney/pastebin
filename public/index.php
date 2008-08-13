<?php
$base  = realpath(dirname(__FILE__) . '/../');
$paths = array(
    '.', 
    $base . '/application/models',
    $base . '/library',
);
ini_set('include_path', implode(PATH_SEPARATOR, $paths));
ini_set('display_errors', false);
error_reporting(E_ALL | E_STRICT);
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

$front = Zend_Controller_Front::getInstance();
$front->registerPlugin(new My_Plugin_Initialize($base, 'development'))
      ->addControllerDirectory($base . '/application/controllers');

// $front->throwExceptions(true);
$front->dispatch();
