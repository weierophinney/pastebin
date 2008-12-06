<?php
require_once dirname(__FILE__) . '/Bug.php';
require_once dirname(__FILE__) . '/RelationType.php';

class Spindle_Model_DbTable_BugRelation extends Zend_Db_Table_Abstract
{
    protected $_name    = 'bug_relation';
    protected $_primary = 'id';

    protected $_referenceMap = array(
        'BugChildren' => array(
            'columns'       => 'related_id',
            'refTableClass' => 'Spindle_Model_DbTable_Bug',
            'refColumns'    => 'id',
        ),
        'BugParent' => array(
            'columns'       => 'bug_id',
            'refTableClass' => 'Spindle_Model_DbTable_Bug',
            'refColumns'    => 'id',
        ),
        'RelationType' => array(
            'columns'       => 'relation_type',
            'refTableClass' => 'Spindle_Model_DbTable_RelationType',
            'refColumns'    => 'id',
        ),
    );
}
