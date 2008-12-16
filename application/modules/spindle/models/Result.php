<?php
class Spindle_Model_Result
{
    protected $_data;

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public function __set($key, $value)
    {
        if (!array_key_exists($key, $this->_data)) {
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
