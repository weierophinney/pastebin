<?php
defined('APPLICATION_PATH') 
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application/'));
defined('APPLICATION_ENV') 
    || define('APPLICATION_ENV', 'testing');

if (!class_exists('Zend_Registry', false) || !Zend_Registry::isRegistered('config')) {

    if (!class_exists('Zend_Registry')) {
        $paths = array(
            '.', 
            APPLICATION_PATH . '/../library',
        );
        ini_set('include_path', implode(PATH_SEPARATOR, $paths));
        require_once 'Zend/Loader.php';
        Zend_Loader::registerAutoload();
    }

    $config = new Zend_Config_Ini(APPLICATION_PATH . '/config/site.ini', APPLICATION_ENV);
    Zend_Registry::set('config', $config);
    unset($base, $path, $config);
}


