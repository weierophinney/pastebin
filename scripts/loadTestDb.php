<?php
/**
 * Script for creating and loading test database
 */

include dirname(__FILE__) . '/_base.php';

$config = Zend_Registry::get('config');

if (file_exists($config->db->cxn->params->dbname)) {
    unlink($config->db->cxn->params->dbname);
}

$db = Zend_Db::factory($config->db->cxn);
Zend_Db_Table_Abstract::setDefaultAdapter($db);

foreach (array('pasteSchema.sqlite.php', 'bugsSchema.sqlite.php') as $schema) {
    $statements = include $config->appPath . '/../data/' . $schema;
    foreach ($statements as $statement) {
        $db->query($statement);
    }
}

return true;
