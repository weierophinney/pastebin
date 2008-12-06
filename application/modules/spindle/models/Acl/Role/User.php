<?php
class Spindle_Model_Acl_Role_User implements Zend_Acl_Role_Interface
{
    public function getRoleId()
    {
        return 'user';
    }
}
