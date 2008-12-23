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

        $this->populate($data);
    }

    public function __set($key, $value)
    {
        if (!in_array($key, $this->_allowed)) {
            throw new Spindle_Model_Exception('Result does not allow setting arbitrary values ("' . $key . '")');
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

    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }

    public function __unset($key)
    {
        if ($this->__isset($key)) {
            unset($this->_data[$key]);
        }
    }

    public function populate($data)
    {
        if (null === $data) {
            return;
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
                $this->{$key} = $value;
            }
        }
    }

    public function toArray()
    {
        return $this->_data;
    }

    public function toJson()
    {
        return Zend_Json::encode($this->toArray());
    }
}
