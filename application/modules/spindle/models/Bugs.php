<?php
class Spindle_Model_Bugs extends Spindle_Model_ResultSet
{
    protected $_gateway;

    protected $_resultClass = 'Spindle_Model_Bug';

    public function __construct($results, $gateway = null)
    {
        if (null === $gateway) {
            throw new Spindle_Model_Exception('No gateway provided to result set');
        }
        $this->setGateway($gateway);

        parent::__construct($results);
    }

    public function setGateway(Spindle_Model_BugTracker $gateway)
    {
        $this->_gateway = $gateway;
        return $this;
    }

    public function getGateway()
    {
        return $this->_gateway;
    }

    public function current()
    {
        if (is_array($this->_resultSet)) {
            $result = current($this->_resultSet);
        } else {
            $result = $this->_resultSet->current();
        }

        if (is_array($result)) {
            $key = key($this->_resultSet);
            $this->_resultSet[$key] = new $this->_resultClass(
                $result, 
                array('gateway' => $this->getGateway())
            );
            $result = $this->_resultSet[$key];
        }
        return $result;
    }
}
