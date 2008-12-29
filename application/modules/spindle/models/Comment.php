<?php
class Spindle_Model_Comment extends Spindle_Model_Value implements Zend_Acl_Resource_Interface
{
    protected $_acl;

    protected $_allowed = array(
        'id',
        'user_id',
        'path',
        'comment',
        'date_created',
        'date_deleted',
    );

    protected $_forms = array(
        'Comment' => false,
    );

    protected $_identity;

    protected $_table;

    /**
     * Constructor
     * 
     * @param  int|array|object $data 
     * @param  null|array|object $options 
     * @return void
     */
    public function __construct($data, $options = null)
    {
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
     * ACL resource
     * 
     * @return string
     */
    public function getResourceId()
    {
        return 'comment';
    }

    /**
     * Overload: set object properties
     * 
     * @param  string $name 
     * @param  mixed $value 
     * @return void
     */
    public function __set($name, $value)
    {
        if (!in_array($name, $this->_allowed)) {
            return;
        }

        $inputFilter = $this->getForm();
        if ($element = $inputFilter->getElement($name)) {
            if (!$element->isValid($value)) {
                return;
            }
            $value = $element->getValue();
        }

        $this->_data[$name] = $value;
    }

    /**
     * Populate comment
     * 
     * @param  array|object $data 
     * @return bool
     */
    public function populate($data)
    {
        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        } elseif (is_object($data)) {
            $data = (array) $data;
        }
        if (!is_array($data)) {
            throw new Spindle_Model_Exception('Invalid data provided to populate comment');
        }

        $inputFilter = $this->getForm();
        if (!$inputFilter->isValid($data)) {
            return false;
        }

        $this->_data = array_merge($this->_data, $inputFilter->getValues());
        return true;
    }

    /**
     * Get comment form
     * 
     * @param  string $form 
     * @return Zend_Form
     */
    public function getForm($form = 'Comment')
    {
        $form = ucfirst(strtolower($form));
        if (array_key_exists($form, $this->_forms) && !$this->_forms[$form]) {
            $class = 'Spindle_Model_Form_' . $form;
            $this->_forms[$form] = new $class;
        }
        return $this->_forms[$form];
    }

    /**
     * Set DB Table instance
     * 
     * @param  Spindle_Model_DbTable_Comment $table 
     * @return Spindle_Model_Comment
     */
    public function setDbTable(Spindle_Model_DbTable_Comment $table)
    {
        $this->_table = $table;
        return $this;
    }

    /**
     * Retrieve db table instance
     * 
     * @return Spindle_Model_DbTable_Comment
     */
    public function getDbTable()
    {
        if (null === $this->_table) {
            $this->setDbTable(new Spindle_Model_DbTable_Comment());
        }
        return $this->_table;
    }

    public function setIdentity(Spindle_Model_User $user)
    {
        $this->_identity = $user;
        return $this;
    }

    public function getIdentity()
    {
        if (null === $this->_identity) {
            $auth = Zend_Auth::getInstance();
            if ($auth->hasIdentity()) {
                $this->setIdentity($auth->getIdentity());
            }
        }
        return $this->_identity;
    }

    public function setAcl(Spindle_Model_Acl_Spindle $acl)
    {
        if (!$acl->has($this)) {
            $acl->add($this)
                ->allow('guest',     $this, array('list'))
                ->allow('user',      $this, array('save'))
                ->allow('developer', $this, array('delete'));
        }

        $this->_acl = $acl;
        return $this;
    }

    public function getAcl()
    {
        if (null === $this->_acl) {
            $this->setAcl(new Spindle_Model_Acl_Spindle());
        }
        return $this->_acl;
    }

    public function checkAcl($action)
    {
        return $this->getAcl()->isAllowed(
            $this->getIdentity(),
            $this,
            $action
        );
    }

    public function fetch($criteria = null)
    {
        $table  = $this->getDbTable();
        $select = $table->select();
        if ($criteria) {
            $select->where('id = ?', $criteria);
        } else {
            if (isset($this->id)) {
                $select->where('id = ?', $this->id);
                $criteria = $this->id;
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

    public function save($data = null)
    {
        if (!$this->checkAcl('save')) {
            $this->getForm()->addErrorMessage('You do not have credentials to comment');
            return false;
        }

        if (null !== $data) {
            $data = (array) $data;
            $inputFilter = $this->getForm();
            if (!$inputFilter->isValid($data)) {
                return false;
            }
            $this->populate($inputFilter->getValues());
        }

        $table  = $this->getDbTable();
        if (!$this->id) {
            $id = $table->insert($this->_data);
            $this->id = $id;
        } else {
            $data = $this->_data;
            unset($data['id']);

            $id    = $this->id;
            $where = $table->getAdapter()->quoteInto('id = ?', $id);

            $table->update($data, $where);
        }

        return $id;
    }

    public function delete($id = null)
    {
        if (!$this->checkAcl('delete')) {
            return false;
        }

        if (!$id && !$this->id) {
            return false;
        } elseif (!$id) {
            $id = $this->id;
        }

        $this->getDbTable();
        $where = $table->getAdapter()->quoteInto('id = ?', $id);
        if ($table->update(
            array('date_deleted' => date('Y-m-d')),
            $where)
        ) {
            $this->_data = array();
            return true;
        }

        return false;
    }
}
