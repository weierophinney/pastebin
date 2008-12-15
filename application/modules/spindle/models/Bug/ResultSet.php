<?php
class Spindle_Model_Bug_ResultSet implements Iterator,Countable
{
    protected $_count;
    protected $_resultSet;

    public function __construct($results)
    {
        $this->_resultSet = $results;
    }

    public function count()
    {
        if (null === $this->_count) {
            $this->_count = count($this->_resultSet);
        }
        return $this->_count;
    }

    public function current()
    {
        $result = current($this->_resultSet);
        if (is_array($result)) {
            $key = key($this->_resultSet);
            $this->_resultSet[$key] = new Spindle_Model_Bug_Result($result);
            $result = $this->_resultSet[$key];
        }
        return $result;
    }

    public function key()
    {
        return key($this-_resultSet);
    }

    public function next()
    {
        return next($this->_resultSet);
    }

    public function rewind()
    {
        return reset($this->_resultSet);
    }

    public function valid()
    {
        return (bool) $this->current();
    }
}
