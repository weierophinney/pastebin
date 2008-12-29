<?php
class Spindle_Model_Validate_UniqueUsername extends Zend_Validate_Abstract
{
    const USER_EXISTS = 'userExists';

    protected $_messageTemplates = array(
        self::USER_EXISTS => 'User identified by "%value%" already exists in our system',
    );

    protected $_model;

    public function __construct(Spindle_Model_User $model = null)
    {
        $this->_model = $model;
    }

    public function isValid($value, $context = null)
    {
        $this->_setValue($value);

        if (!$this->getModel()->fetch($value)) {
            return true;
        }

        $this->_error(self::USER_EXISTS);
        return false;
    }

    public function setModel(Spindle_Model_User $model = null)
    {
        $this->_model = $model;
        return $this;
    }

    public function getModel()
    {
        if (null === $this->_model) {
            $this->setModel(new Spindle_Model_User(array()));
        }
        return $this->_model;
    }
}
