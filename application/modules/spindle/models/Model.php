<?php
/**
 * Base model
 *
 * Defines methods for setting options, retrieving resource loader, creating 
 * and manipulating plugin hooks, and registering and manipulating plugins.
 * 
 * @package    Spindle
 * @subpackage Model
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
abstract class Spindle_Model_Model
{
    /**
     * @var Spindle_Model_Acl_Spindle
     */
    protected $_acl;

    /**
     * @var string Resource in ACL to query
     */
    protected $_aclResource;

    /**
     * @var array Class methods
     */
    protected $_classMethods;

    /**
     * @var array registry of table objects
     */
    protected $_dbTables = array();

    /**
     * @var string Default validator to use; used to construct form accessor
     */
    protected $_defaultValidator;

    /**
     * @var stdClass|null
     */
    protected $_identity;

    /**
     * Primary table for operations
     * @var string
     */
    protected $_primaryTable = 'user';

    /**
     * Columns that may not be specified in save operations
     * @var array
     */
    protected $_protectedColumns = array();

    /**
     * @var My_Controller_Helper_ResourceLoader
     */
    protected $_resourceLoader;

    /**
     * Constructor
     * 
     * @param  array|Zend_Config|null $options 
     * @return void
     */
    public function __construct($options = null)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }

        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set options using setter methods
     * 
     * @param  array $options 
     * @return Spindle_Model_Paste
     */
    public function setOptions(array $options)
    {
        if (null === $this->_classMethods) {
            $this->_classMethods = get_class_methods($this);
        }
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $this->_classMethods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * Set resource loader
     * 
     * @param  object $loader 
     * @return Spindle_Model_DbTable_Paste
     */
    public function setResourceLoader($loader)
    {
        if (!is_object($loader)) {
            throw new Exception('Invalid resource loader provided to ' . __CLASS__);
        }
        $this->_resourceLoader = $loader;
        return $this;
    }

    /**
     * Retrieve resource loader
     * 
     * @return object
     */
    public function getResourceLoader()
    {
        if (null === $this->_resourceLoader) {
            $this->_resourceLoader = new My_Controller_Helper_ResourceLoader;
            $this->_resourceLoader->initModule('spindle');
        }
        return $this->_resourceLoader;
    }

    /**
     * Set identity of current user
     * 
     * @param  mixed $identity 
     * @return Spindle_Model_Model
     */
    public function setIdentity($identity)
    {
        if (is_array($identity)) {
            $identity = (object) $identity;
        } elseif (is_scalar($identity) && !is_bool($identity)) {
            $identity = new stdClass;
            $identity->id = $identity;
        } elseif (null === $identity) {
            $identity = null;
        } elseif (!is_object($identity)) {
            throw new Spindle_Model_Exception('Invalid identity provided');
        }
        $this->_identity = $identity;
        return $this;
    }

    /**
     * Retrieve identity
     * 
     * @return stdClass
     */
    public function getIdentity()
    {
        return $this->_identity;
    }

    /**
     * Set ACLs
     * 
     * @param  Zend_Acl $acl 
     * @return Spindle_Model_Model
     */
    public function setAcl(Zend_Acl $acl)
    {
        $this->_acl = $acl;
        return $this;
    }

    /**
     * Retrieve ACLs
     *
     * If none set, uses {@link Spindle_Model_Acl_Spindle}
     * 
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if (null === $this->_acl) {
            $this->setAcl(new Spindle_Model_Acl_Spindle());
        }
        return $this->_acl;
    }

    /**
     * Check ACLs
     * 
     * @param  string $privilege 
     * @return bool
     */
    public function checkAcl($privilege)
    {
        $identity = $this->getIdentity();
        if (!$identity || !isset($identity->role)) {
            $role = 'guest';
        } else {
            $role = $identity->role;
        }
        if (null === $this->_aclResource) {
            throw new Spindle_Model_Exception('No ACL resource defined');
        }

        return $this->getAcl()->isAllowed($role, $this->_aclResource, $privilege);
    }

    /**
     * Insert or update a row
     * 
     * @pubsub Spindle_Model::save::pre(array $info, string $validator, Spindle_Model_Model $model)
     * @pubsub Spindle_Model::save::preSave(Zend_Db_Table_Row_Abstract $row, Spindle_Model_Model $model)
     * @pubsub Spindle_Model::save::post(int|null $id, Spindle_Model_Model $model)
     * @param  array $info New or updated row data
     * @param  string|null $validator Validation chain to use; defaults to $_defaultValidator
     * @return false|int Row ID of saved row, false if insufficient privileges
     */
    public function save(array $info, $validator = null)
    {
        Phly_PubSub::publish('Spindle_Model::save::pre', $info, $validator, $this);
        if (!$this->checkAcl('save')) {
            return false;
        }

        if (empty($validator)) {
            $validator = $this->_defaultValidator;
        }

        $accessor  = 'get' . ucfirst($validator) . 'Form';
        $validator = $this->$accessor();
        $table     = $this->getDbTable($this->_primaryTable);
        $id        = null;
        $row       = null;

        if (!$validator->isValid($info)) {
            return false;
        }

        $info = $validator->getValues();
        if (null !== ($parent = $validator->getElementsBelongTo())) {
            $info = $info[$parent];
        }


        if (array_key_exists('id', $info)) {
            $id = $info['id'];
            unset($info['id']);
            $matches = $table->find($id);
            if (0 < count($matches)) {
                $row = $matches->current();
            }
        }
        if (null === $row) {
            $row = $table->createRow();
            $row->date_created = date('Y-m-d');
        }

        $columns = $table->info('cols');
        foreach ($this->_protectedColumns as $column) {
            unset($columns[$column]);
        }
        foreach ($columns as $column) {
            if (array_key_exists($column, $info)) {
                $row->$column = $info[$column];
            }
        }

        Phly_PubSub::publish('Spindle_Model::save::preSave', $row, $this);
        $id = $row->save();

        Phly_PubSub::publish('Spindle_Model::save::post', $id, $this);
        return $id;
    }

    /**
     * Lazy loaded DB Table registry
     * 
     * @param  string $name 
     * @return Zend_Db_Table_Abstract
     */
    public function getDbTable($name)
    {
        if (!isset($this->_dbTables[$name])) {
            $class = 'Spindle_Model_DbTable_' . ucfirst($name);
            $this->_dbTables[$name] = new $class;
        }
        return $this->_dbTables[$name];
    }

}
