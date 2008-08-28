<?php
$bootstrap = true;
$base      = realpath(dirname(__FILE__) . '/../');
$paths     = array(
    '.', 
    $base . '/application/models',
    $base . '/library',
);
ini_set('include_path', implode(PATH_SEPARATOR, $paths));
ini_set('display_errors', false);
error_reporting(E_ALL | E_STRICT);

include dirname(__FILE__) . '/../application/bootstrap.php';

Zend_Controller_Front::getInstance()->dispatch();
