<?php
require_once dirname(__FILE__) . '/Bug.php';
require_once dirname(__FILE__) . '/Comment.php';

class Spindle_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary = 'id';

    protected $_dependentTables = array(
        'Spindle_Model_DbTable_Bug',
        'Spindle_Model_DbTable_Comment',
    );
}
