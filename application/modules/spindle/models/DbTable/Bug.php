<?php
require_once dirname(__FILE__) . '/BugRelation.php';
require_once dirname(__FILE__) . '/Comment.php';
require_once dirname(__FILE__) . '/IssueType.php';
require_once dirname(__FILE__) . '/ResolutionType.php';
require_once dirname(__FILE__) . '/PriorityType.php';

class Spindle_Model_DbTable_Bug extends Zend_Db_Table_Abstract
{
    protected $_name    = 'bug';
    protected $_primary = 'id';

    protected $_dependentTables = array(
        'Spindle_Model_DbTable_BugRelation',
        'Spindle_Model_DbTable_Comment',
    );

    protected $_referenceMap = array(
        'IssueType' => array(
            'columns'       => 'type_id',
            'refTableClass' => 'Spindle_Model_DbTable_IssueType',
            'refColumns'    => 'id',
        ),
        'ResolutionType' => array(
            'columns'       => 'resolution_id',
            'refTableClass' => 'Spindle_Model_DbTable_ResolutionType',
            'refColumns'    => 'id',
        ),
        'PriorityType' => array(
            'columns'       => 'priority_id',
            'refTableClass' => 'Spindle_Model_DbTable_PriorityType',
            'refColumns'    => 'id',
        ),
    );
}
