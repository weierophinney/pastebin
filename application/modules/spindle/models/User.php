<?php
/** Spindle_Model_Model */
require_once dirname(__FILE__) . '/Model.php';

/**
 * User model
 * 
 * @uses       Spindle_Model_Model
 * @package    Spindle
 * @subpackage Model
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Model_User extends Spindle_Model_Model
{
    protected $_primaryTable = 'user';

    protected $_protectedColumns = array(
        'date_created',
        'date_banned',
    );

    /**
     * Fetch all current users
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchUsers()
    {
        $table  = $this->getResourceLoader()->getDbTable('user');
        $select = $table->select();
        $select->from($table, array('id', 'username', 'email', 'fullname', 'date_created'))
               ->where('date_banned IS NULL');
        return $table->fetchAll($select);
    }

    /**
     * Fetch user
     * 
     * @param  int|string $id User id, username, or email
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function fetchUser($id)
    {
        $table   = $this->getResourceLoader()->getDbTable('user');
        $adapter = $table->getAdapter();

        $select = $table->select();
        $select->where('date_banned IS NULL')
               ->where($this->_createUserCondition($id));
        return $table->fetchRow($select);
    }

    /**
     * Ban a user
     * 
     * @param  int|string $id User id, email, or username
     * @return int Row affected
     */
    public function ban($id)
    {
        $table = $this->getResourceLoader()->getDbTable('user');
        $where = $this->_createUserCondition($id);
        return $table->update(
            array('date_banned' => date('Y-m-d')),
            $where
        );
    }

    /**
     * Save user
     * 
     * @param  array $info 
     * @param  string|null $tableName 
     * @return int
     * @throws Exception with duplicate user or missing information
     */
    public function save(array $info, $tableName = null)
    {
        if (!array_key_exists('id', $info)) {
            if (!array_key_exists('username', $info)) {
                throw new Exception('Username is required');
            }
            if (!array_key_exists('email', $info)) {
                throw new Exception('Email is required');
            }
            $table = $this->getResourceLoader()->getDbTable('user');
            $select = $table->select();
            $select->where('username = ?', $info['username'])
                   ->orWhere('email = ?', $info['email']);
            $rows = $table->fetchAll($select);
            if (0 < count($rows)) {
                throw new Exception('Invalid user; duplicates existing user in database');
            }
        }

        if (array_key_exists('password', $info)) {
            $info['password'] = md5($info['password']);
        }
        return parent::save($info, $tableName);
    }

    /**
     * Create the user condition
     * 
     * @param  int|string $id 
     * @return string
     */
    protected function _createUserCondition($id)
    {
        $table   = $this->getResourceLoader()->getDbTable('user');
        $adapter = $table->getAdapter();
        $conditions = array();
        foreach (array('id', 'email', 'username') as $field) {
            $conditions[] = $adapter->quoteInto($field . ' = ?', $id);
        }
        return implode(' OR ', $conditions);
    }
}
