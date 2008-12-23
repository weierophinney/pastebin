<?php
class Spindle_Model_UserManager_Users extends Spindle_Model_ResultSet
{
    protected $_manager;
    protected $_resultClass = 'Spindle_Model_UserManager_User';

    public function setManager(Spindle_Model_UserManager $manager)
    {
        $this->_manager = $manager;
        return $this;
    }

    public function getManager()
    {
        return $this->_manager;
    }

    public function current()
    {
        $result = parent::current();
        $result->setManager($this->getManager());
        return $result;
    }
}
