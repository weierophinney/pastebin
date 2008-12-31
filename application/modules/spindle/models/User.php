<?php
class Spindle_Model_User 
    extends Spindle_Model_Value 
    implements Zend_Auth_Adapter_Interface, Zend_Acl_Role_Interface
{
    /**
     * @var array Allowed properties
     */
    protected $_allowed = array(
        'id',
        'username',
        'password',
        'email',
        'fullname',
        'role',
        'date_created',
        'date_banned',
    );

    /**
     * @var array Form instances
     */
    protected $_form = array(
        'Login'    => null,
        'Register' => null,
    );

    /**
     * @var Phly_PubSub_Provider
     */
    protected $_pluginProvider;

    /**
     * @var Spindle_Model_DbTable_User
     */
    protected $_table;

    /**
     * Constructor
     * 
     * @param  array|object $data 
     * @param  Spindle_Model_UserGateway $gateway 
     * @return void
     */
    public function __construct($data, $options = null)
    {
        $this->_pluginProvider = new Phly_PubSub_Provider();

        if (is_string($data)) {
            if (!$this->fetch($data)) {
                throw new Spindle_Model_Exception('Could not load user from provided data');
            }
            $this->setOptions($options);
            return;
        }

        parent::__construct($data, $options);
    }

    /**
     * Serialization (used for sessions)
     *
     * Only serialize properties that can be.
     * 
     * @return array
     */
    public function __sleep()
    {
        return array('_data', '_allowed');
    }

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
        if (!in_array($name, $this->_allowed)) {
            throw new Spindle_Model_Exception(sprintf('Invalid parameter "%s" specified', $name));
        }

        if ('password' == $name) {
            $this->_data['password'] = md5($value);
            return;
        }

        $inputFilter = $this->getForm('register');
        if ($element = $inputFilter->getElement($name)) {
            if (!$element->isValid($value)) {
                throw new Spindle_Model_Exception(sprintf('Invalid value specified for %s: %s', $name, $value));
            }
            $value = $element->getValue();
        }

        $this->_data[$name] = $value;
    }

    /**
     * Set DB Table instance
     * 
     * @param  Spindle_Model_DbTable_User $table 
     * @return Spindle_Model_User
     */
    public function setDbTable(Spindle_Model_DbTable_User $table)
    {
        $this->_table = $table;
        return $this;
    }

    /**
     * Retrieve db table instance
     * 
     * @return Spindle_Model_DbTable_User
     */
    public function getDbTable()
    {
        if (null === $this->_table) {
            $this->setDbTable(new Spindle_Model_DbTable_User());
        }
        return $this->_table;
    }

    /**
     * Authenticate user
     *
     * Attempts to authenticate user. If successful, populates object from user 
     * with matching credentials.
     * 
     * @see    Zend_Auth_Adapter_Interface
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        $table  = $this->getDbTable();
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

    /**
     * ACL role
     * 
     * @see    Zend_Acl_Role_Interface
     * @return string
     */
    public function getRoleId()
    {
        if (!isset($this->role)) {
            return 'guest';
        }
        return $this->role;
    }

    /**
     * Retrieve login/register form
     * 
     * @return Spindle_Model_Form_Login|Spindle_Model_Form_Register
     */
    public function getForm($type)
    {
        $type = ucfirst(strtolower($type));
        if (!array_key_exists($type, $this->_form)) {
            throw new Spindle_Model_Exception('Invalid form type requested');
        }

        if (null === $this->_form[$type]) {
            $class = 'Spindle_Model_Form_' . $type;
            $this->_form[$type] = new $class(array('model' => $this));
        }
        return $this->_form[$type];
    }

    /**
     * Get PubSub provider
     * 
     * @return Phly_PubSub_Provider
     */
    public function getPluginProvider()
    {
        return $this->_pluginProvider;
    }

    /**
     * Fetch an individual user and populate the current object
     * 
     * @param  null|string $criteria 
     * @return bool
     */
    public function fetch($criteria = null)
    {
        $table  = $this->getDbTable();
        $select = $table->select();
        if ($criteria) {
            $select->where('username = ?', $criteria)
                   ->orWhere('email = ?', $criteria)
                   ->orWhere('id = ?', $criteria);
        } else {
            if (isset($this->id)) {
                $select->where('id = ?', $this->id);
                $criteria = $this->id;
            } elseif (isset($this->username)) {
                $select->where('username = ?', $this->username);
                $criteria = $this->username;
            } elseif (isset($this->email)) {
                $select->where('email = ?', $this->email);
                $criteria = $this->email;
            }
            if (null === $criteria) {
                throw new Spindle_Model_Exception('No criteria provided');
            }
        }

        $row = $table->fetchRow($select);
        if ($row) {
            $this->populate($row);
            return true;
        }

        return false;
    }

    /**
     * Save user
     * 
     * @param  array|object $data
     * @return int|false User id on success; false on failure
     */
    public function save($data = null)
    {
        $this->getPubSub()->publish('save::start', $data, $this);

        if (null !== $data) {
            $data = (array) $data;
            $inputFilter = $this->getForm('register');
            if (!$inputFilter->isValid($data)) {
                return false;
            }
            $this->populate($inputFilter->getValues());
        }

        $table  = $this->getDbTable();
        if (!$this->id) {
            $select = $table->select();
            $select->where('username = ?', $this->username)
                   ->orWhere('email = ?', $this->email);
            $rows   = $table->fetchAll($select);
            if (0 < count($rows)) {
                $this->getForm('register')->addErrorMessage(
                    'Invalid user; duplicates existing user in database'
                );
                return false;
            }

            $id = $table->insert($this->_data);
            $this->id = $id;
        } else {
            $data = $this->_data;
            unset($data['id']);

            $id    = $this->id;
            $where = $table->getAdapter()->quoteInto('id = ?', $id);

            $table->update($data, $where);
        }

        $this->getPubSub()->publish('save::end', $id, $this);
        return $id;
    }
}
