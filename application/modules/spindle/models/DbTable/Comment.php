<?php
require_once dirname(__FILE__) . '/User.php';
require_once dirname(__FILE__) . '/Bug.php';

class Spindle_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{
    protected $_name    = 'comment';
    protected $_primary = 'id';

    protected $_referenceMap = array(
        'User' => array(
            'columns'       => 'user_id',
            'refTableClass' => 'Spindle_Model_DbTable_User',
            'refColumns'    => 'id',
        ),
        'Bug' => array(
            'columns'       => 'bug_id',
            'refTableClass' => 'Spindle_Model_DbTable_Bug',
            'refColumns'    => 'id',
        ),
    );
}
