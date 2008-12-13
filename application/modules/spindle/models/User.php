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
class Spindle_Model_User extends Spindle_Model_Model implements Zend_Auth_Adapter_Interface
{
    /** @var string Primary table */
    protected $_primaryTable = 'user';

    /** @var array Columns protected from insert/update */
    protected $_protectedColumns = array(
        'date_created',
        'date_banned',
    );

    /** @var string username to authenticate */
    protected $_identity;

    /** @var string password to use when authenticating */
    protected $_credentials;

    /** @var Spindle_Model_Form_Login */
    protected $_formLogin;

    /** @var Spindle_Model_Form_Register */
    protected $_formRegister;

    /**
     * Set authentication identity
     * 
     * @param  string $username 
     * @return Spindle_Model_User
     */
    public function setIdentity($username)
    {
        $this->_identity = (string) $username;
        return $this;
    }

    /**
     * Retrieve user identity
     * 
     * @return string|null
     */
    public function getIdentity()
    {
        return $this->_identity;
    }

    /**
     * Set authentication credentials
     * 
     * @param  string $password 
     * @return Spindle_Model_User
     */
    public function setCredentials($password)
    {
        $this->_credentials = (string) $password;
        return $this;
    }

    /**
     * Retrieve authentication credentials
     * 
     * @return string|null
     */
    public function getCredentials()
    {
        return $this->_credentials;
    }

    /**
     * Authenticate a user
     * 
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        $table = new Spindle_Model_DbTable_User;
        $select = $table->select();
        $select->where('username = ?', $this->getIdentity())
               ->where('password = ?', md5($this->getCredentials()))
               ->where('date_banned IS NULL');
        $user = $table->fetchRow($select);
        if (null === $user) {
            // failed
            $result = new Zend_Auth_Result(
                Zend_Auth_Result::FAILURE_UNCATEGORIZED,
                null
            );
        } else {
            // passed
            $identity = $user->toArray();
            unset(
                $identity['password'],
                $identity['date_banned']
            );
            $result = new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, (object) $identity);
        }
        return $result;
    }

    /**
     * Fetch all current users
     * 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function fetchUsers()
    {
        $table  = new Spindle_Model_DbTable_User;
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
        $table   = new Spindle_Model_DbTable_User;
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
        $table = new Spindle_Model_DbTable_User;
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
     * @param  string|null $validator Validation chain to use
     * @return int|false
     * @throws Exception with duplicate user or missing information
     */
    public function save(array $info, $validator = null)
    {
        if (null === $validator) {
            $validator = 'Register';
        }

        Phly_PubSub::publish(__CLASS__ . '::save::start', $info, $validator, $this);

        $method = 'get' . ucfirst($validator) . 'Form';
        $form = $this->$method();
        if (!$form->isValid($info)) {
            return false;
        }

        $values = $form->getValues();
        $key    = strtolower($tableName);
        if (array_key_exists($key, $values)) {
            $values = $values[$key];
        }
        if (!array_key_exists('id', $values)) {
            $table  = new Spindle_Model_DbTable_User;
            $select = $table->select();
            $select->where('username = ?', $values['username'])
                   ->orWhere('email = ?', $values['email']);
            $rows   = $table->fetchAll($select);
            if (0 < count($rows)) {
                throw new Exception('Invalid user; duplicates existing user in database');
            }
        }

        if (array_key_exists('password', $values)) {
            $values['password'] = md5($values['password']);
        }
        $id = parent::save($values);

        Phly_PubSub::publish(__CLASS__ . '::save::end', $id, $this);
        return $id;
    }

    /**
     * Retrieve login form
     * 
     * @return Spindle_Model_Form_Login
     */
    public function getLoginForm()
    {
        if (empty($this->_formLogin)) {
            $this->_formLogin = new Spindle_Model_Form_Login;
        }
        return $this->_formLogin;
    }

    /**
     * Retrieve registration form
     * 
     * @return Spindle_Model_Form_Register
     */
    public function getRegisterForm()
    {
        if (empty($this->_formRegister)) {
            $this->_formRegister = new Spindle_Model_Form_Register;
        }
        return $this->_formRegister;
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
