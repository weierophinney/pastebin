<?php
class Spindle_Model_Acl_Role_Manager implements Zend_Acl_Role_Interface
{
    public function getRoleId()
    {
        return 'manager';
    }
}
