<?php
class Spindle_Model_UserManager_User 
    extends Spindle_Model_Result 
    implements Zend_Auth_Adapter_Interface, Zend_Acl_Role_Interface
{
    protected $_allowed = array(
        'username',
        'password',
        'email',
        'fullname',
        'role',
        'date_created',
    );

    /**
     * @var Spindle_Model_UserManager
     */
    protected $_manager;

    /**
     * Overload: set property
     *
     * Overloads 'password' property to set value as md5 sum.
     * 
     * @param  string $name 
     * @param  mixed $value 
     * @return void
     */
    public function __set($name, $value)
    {
        if ('password' == $name) {
            $this->_data['password'] = md5($value);
            return;
        }

        return parent::__set($name, $value);
    }

    public function setManager(Spindle_Model_UserManager $manager)
    {
        $this->_manager = $manager;
        return $this;
    }

    public function getManager()
    {
        return $this->_manager;
    }

    public function authenticate()
    {
        if (null === ($manager = $this->getManager())) {
            throw new Spindle_Model_Exception('User requires access to UserManager in order to authenticate');
        }

        $table  = $manager->getDbTable('user');
        $select = $table->select();
        $select->where('username = ?', $this->username)
               ->where('password = ?', $this->password)
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
            $this->populate($user);
            unset($this->password);
            $result = new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this);
        }
        return $result;
    }

    public function getRoleId()
    {
        if (!isset($this->role)) {
            return 'guest';
        }
        return $this->role;
    }
}
