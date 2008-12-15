<?php
class Spindle_View_Helper_GetRole extends Zend_View_Helper_Abstract
{
    public function getRole()
    {
        return Zend_Registry::get('role');
    }
}

