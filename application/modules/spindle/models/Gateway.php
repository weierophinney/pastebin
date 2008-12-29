<?php
/**
 * Base gateway
 *
 * Defines methods for setting options, retrieving resource loader, creating 
 * and manipulating plugin hooks, and registering and manipulating plugins.
 * 
 * @package    Spindle
 * @subpackage Model
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
abstract class Spindle_Model_Gateway implements Zend_Acl_Resource_Interface
{
    /**
     * @var Spindle_Model_Acl_Spindle
     */
    protected $_acl;

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
     * @var Phly_PubSub_Provider
     */
    protected $_plugins;

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
     * @var string ACL resource identifier
     */
    protected $_resourceId;

    /**
     * @var array Privilege map (role => privileges)
     */
    protected $_privilegeMap;

    /**
     * @var bool Whether or not to use a paginator for result sets
     */
    protected $_usePaginator = false;

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
     * Plugin provider
     * 
     * @return Phly_PubSub_Provider
     */
    public function getPluginProvider()
    {
        if (null === $this->_plugins) {
            $this->_plugins = new Phly_PubSub_Provider();
        }
        return $this->_plugins;
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
        if (null === $this->_identity) {
            $auth = Zend_Auth::getInstance();
            if (!$auth->hasIdentity()) {
                return 'guest';
            }
            $this->setIdentity($auth->getIdentity());
        }

        return $this->_identity;
    }

    /**
     * ACL resource identifier
     * 
     * @return string
     */
    public function getResourceId()
    {
        if (null === $this->_resourceId) {
            throw new Spindle_Model_Exception('No ACL resource identifier specified for model');
        }
        return $this->_resourceId;
    }

    /**
     * ACL privilege map for this resource
     * 
     * @return array
     */
    public function getPrivilegeMap()
    {
        return $this->_privilegeMap;
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

        if (!$acl->has($this)) {
            $acl->add($this);
            foreach ($this->getPrivilegeMap() as $role => $privileges) {
                $acl->allow($role, $this, $privileges);
            }
        }

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
        return $this->getAcl()->isAllowed(
            $this->getIdentity(), 
            $this, 
            $privilege
        );
    }

    /**
     * Set flag indicating whether or not to use paginator
     * 
     * @param  bool $flag 
     * @return Spindle_Model_Model
     */
    public function setUsePaginator($flag)
    {
        $this->_usePaginator = (bool) $flag;
        return $this;
    }

    /**
     * Use a paginator?
     * 
     * @return bool
     */
    public function usePaginator()
    {
        return $this->_usePaginator;
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
