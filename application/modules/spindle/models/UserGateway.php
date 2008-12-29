<?php
/**
 * User gateway
 * 
 * @uses       Spindle_Model_Model
 * @package    Spindle
 * @subpackage Model
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Model_UserGateway extends Spindle_Model_Gateway
{
    /** @var array Array of Zend_Db_Table_Abstract objects */
    protected $_dbTable = array();

    /** @var string Primary table */
    protected $_primaryTable = 'user';

    /** @var array Columns protected from insert/update */
    protected $_protectedColumns = array(
        'date_created',
        'date_banned',
    );

    /**
     * Fetch all current users
     * 
     * @return Spindle_Model_UserManager_Users
     */
    public function fetchUsers()
    {
        $table  = new Spindle_Model_DbTable_User;
        $select = $table->select();
        $select->from($table, array('id', 'username', 'email', 'fullname', 'date_created'))
               ->where('date_banned IS NULL');
        return new Spindle_Model_UserManager_Users($table->fetchAll($select));
    }

    /**
     * Fetch user
     * 
     * @param  int|string $id User id, username, or email
     * @return Spindle_Model_User|null
     */
    public function fetchUser($id)
    {
        $table   = new Spindle_Model_DbTable_User;
        $adapter = $table->getAdapter();

        $select = $table->select();
        $select->where('date_banned IS NULL')
               ->where($this->_createUserCondition($id));
        $row = $table->fetchRow($select);

        if (null === $row) {
            return null;
        }

        $user = new Spindle_Model_User($row, $this);
        return $user;
    }

    /**
     * Ban a user
     * 
     * @param  int|string $id User id, email, or username
     * @return int Row affected
     */
    public function ban($id)
    {
        $table = new Spindle_Model_DbTable_User;
        $where = $this->_createUserCondition($id);
        return $table->update(
            array('date_banned' => date('Y-m-d')),
            $where
        );
    }

    /**
     * 
     * 
     * @param mixed $data 
     * @return void
     */
    public function create($data = null)
    {
        $user = new Spindle_Model_User($data, $this);
        return $user;
    }

    /**
     * Create the user condition
     * 
     * @param  int|string $id 
     * @return string
     */
    protected function _createUserCondition($id)
    {
        $table   = new Spindle_Model_DbTable_User;
        $adapter = $table->getAdapter();
        $conditions = array();
        foreach (array('id', 'email', 'username') as $field) {
            $conditions[] = $adapter->quoteInto($field . ' = ?', $id);
        }
        return implode(' OR ', $conditions);
    }
}
