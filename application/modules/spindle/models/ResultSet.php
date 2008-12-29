<?php
/**
 * Base result set object for models
 * 
 * @uses       Iterator
 * @uses       Countable
 * @package    Spindle
 * @subpackage Model
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
abstract class Spindle_Model_ResultSet implements Iterator,Countable
{
    /**
     * @var int Count of items in result set
     */
    protected $_count;

    /**
     * @var string Result class to use for individual items
     */
    protected $_resultClass;

    /**
     * @var array Actual results
     */
    protected $_resultSet;

    /**
     * Constructor
     * 
     * @param  array|Traversable $results 
     * @return void
     */
    public function __construct($results)
    {
        if (!$this->_resultClass) {
            throw new Spindle_Model_Exception('No result class specified!');
        }

        if (!is_array($results) && (!$results instanceof Traversable)) {
            throw new Spindle_Model_Exception('Invalid result set; must be array or Traversable');
        }

        $this->_resultSet = $results;
    }

    /**
     * Countable: return count of items in result set
     * 
     * @return int
     */
    public function count()
    {
        if (null === $this->_count) {
            $this->_count = count($this->_resultSet);
        }
        return $this->_count;
    }

    /**
     * Iterator: return current item
     * 
     * @return Spindle_Model_Value
     */
    public function current()
    {
        if (is_array($this->_resultSet)) {
            $result = current($this->_resultSet);
        } else {
            $result = $this->_resultSet->current();
        }

        if (is_array($result)) {
            $key = key($this->_resultSet);
            $this->_resultSet[$key] = new $this->_resultClass($result);
            $result = $this->_resultSet[$key];
        }
        return $result;
    }

    /**
     * Iterator: return current key
     * 
     * @return int|string
     */
    public function key()
    {
        if (is_array($this->_resultSet)) {
            return key($this->_resultSet);
        }
        return $this->_resultSet->key();
    }

    /**
     * Iterator: advance to next item in result set
     * 
     * @return void
     */
    public function next()
    {
        if (is_array($this->_resultSet)) {
            return next($this->_resultSet);
        }
        return $this->_resultSet->next();
    }

    /**
     * Iterator: rewind to first item in result set
     * 
     * @return void
     */
    public function rewind()
    {
        if (is_array($this->_resultSet)) {
            return reset($this->_resultSet);
        }
        return $this->_resultSet->rewind();
    }

    /**
     * Iterator: is the current item valid
     * 
     * @return bool
     */
    public function valid()
    {
        return (bool) $this->current();
    }
}
