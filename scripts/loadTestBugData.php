<?php
/**
 * Script for populating test bug database
 */

include dirname(__FILE__) . '/_base.php';

$config = Zend_Registry::get('config');

if (file_exists($config->db->cxn->params->dbname)) {
    return false;
}

$db = Zend_Db::factory($config->db->cxn);
Zend_Db_Table_Abstract::setDefaultAdapter($db);

$statements = include $config->appPath . '/../data/bugsTestData.sqlite.php';
foreach ($statements as $statement) {
    $db->query($statement);
}

return true;
