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
     * @var array Class methods
     */
    protected $_classMethods;

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
     * Insert or update a row
     * 
     * @param  array $info New or updated row data
     * @param  string|null Table name to use (defaults to primaryTable)
     * @return int Row ID of saved row
     */
    public function save(array $info, $tableName = null)
    {
        $tableName = (null === $tableName) ? $this->_primaryTable : $tableName;
        $table = $this->getResourceLoader()->getDbTable($tableName);
        $id    = null;
        $row   = null;
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

        return $row->save();
    }
}
