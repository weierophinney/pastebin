<?php
require_once dirname(__FILE__) . '/BugRelation.php';

class Spindle_Model_DbTable_RelationType extends Zend_Db_Table_Abstract
{
    protected $_name    = 'relation_type';
    protected $_primary = 'id';

    protected $_dependentTables = array(
        'Spindle_Model_DbTable_BugRelation',
    );
}