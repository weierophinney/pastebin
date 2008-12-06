<?php
class Spindle_Model_Acl_Resource_Comment implements Zend_Acl_Resource_Interface
{
    public function getResourceId()
    {
        return 'comment';
    }
}
