<?php
/**
 * Pastebin model
 * 
 * @package   Paste
 * @license   New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version   $Id: $
 */
class Paste
{
    /**
     * Table fields
     * @var array
     */
    protected $_fields;

    /**
     * Form representation/input filter of model data
     * 
     * @var PasteForm
     */
    protected $_form;

    /**
     * @var Zend_Db_Table_Abstract
     */
    protected $_table;

    /**
     * Add a paste
     * 
     * @param  array $data 
     * @return string
     */
    public function add(array $data)
    {
        $form     = $this->getForm();

        $belongTo = $form->getElementsBelongTo();
        if (!empty($belongTo) && array_key_exists($belongTo, $data)) {
            $data = $data[$belongTo];
        }

        if (!$form->isValid($data)) {
            return false;
        }

        $values = $form->getValues();
        if (!empty($belongTo)) {
            $values = $values[$belongTo];
        }

        return $this->_getTable()->insert($values);
    }

    /**
     * Fetch a paste by id
     *
     * Returns boolean false on failure to find the paste; otherwise, a struct 
     * is returned.
     * 
     * @param  string $id 
     * @return struct|false
     */
    public function get($id)
    {
        $table  = $this->_getTable();
        $select = $table->select();
        $select->where('id = ?', $id)
               ->where('expires IS NULL OR expires = "" OR expires > ?', date('Y-m-d H:i:s'));
        $row    = $table->fetchRow($select);
        if (null == $row) {
            return false;
        }
        $data = $row->toArray();
        $data['children'] = $this->_getChildren($id);
        return $data;
    }

    /**
     * Get list of active pastes, ordered by creation date (desc)
     * 
     * @return array
     */
    public function fetchActive()
    {
        $table   = $this->_getTable();
        $adapter = $table->getAdapter();
        $select  = $adapter->select();
        $select->from('paste', array('id', 'type', 'summary', 'user', 'created', 'expires'))
               ->where('expires IS NULL OR expires = "" OR expires > ?', date('Y-m-d H:i:s'))
               ->order('created DESC');

        return $adapter->fetchAll($select);
    }

    public function fetchActiveCount()
    {
        $table   = $this->_getTable();
        $adapter = $table->getAdapter();
        $select  = $adapter->select();
        $select->from('paste', array('count' => 'COUNT(*)'))
               ->where('expires IS NULL OR expires = "" OR expires > ?', date('Y-m-d H:i:s'))
               ->order('created DESC');

        return $adapter->fetchOne($select);
    }

    /**
     * Retrieve form/input filter
     * 
     * @return Paste_Form
     */
    public function getForm()
    {
        if (null === $this->_form) {
            require_once dirname(__FILE__) . '/Paste/Form.php';
            $this->_form = new Paste_Form();
        }
        return $this->_form;
    }

    /**
     * Retrieve data provider
     * 
     * @return Paste_Table
     */
    protected function _getTable()
    {
        if (null === $this->_table) {
            $this->_table = new Paste_Table();
        }
        return $this->_table;
    }

    /**
     * Retrieve table fields
     * 
     * @return array
     */
    protected function _getFields()
    {
        if (null === $this->_fields) {
            $this->_fields = $this->_getTable()->info('cols');
        }
        return $this->_fields;
    }

    /**
     * Retrieve paste children
     * 
     * @param  string $id 
     * @return false|array
     */
    protected function _getChildren($id)
    {
        $adapter = $this->_getTable()->getAdapter();
        $select  = $adapter->select();
        $select->from('paste', array('id'))
               ->where('parent = ?', $id);
        return $adapter->fetchCol($select);
    }
}
