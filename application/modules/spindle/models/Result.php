<?php
abstract class Spindle_Model_Result
{
    protected $_allowed = array();
    protected $_data    = array();

    public function __construct($data)
    {
        if (empty($this->_allowed)) {
            throw new Spindle_Model_Exception('No allowed fields specified!');
        }

        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        } elseif (is_object($data)) {
            $data = (array) $data;
        }

        if (!is_array($data)) {
            throw new Spindle_Model_Exception('Invalid data provided to constructor');
        }

        foreach ($data as $key => $value) {
            if (in_array($key, $this->_allowed)) {
                $this->_data[$key] = $value;
            }
        }
    }

    public function __set($key, $value)
    {
        if (!in_array($key, $this->_allowed)) {
            throw new Spindle_Model_Exception('Bug result does not allow setting arbitrary values');
        }
        $this->_data[$key] = $value;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->_data)) {
            return null;
        }
        return $this->_data[$key];
    }
}
