<?php
class Spindle_View_Helper_CheckAcl extends Zend_View_Helper_Abstract
{
    public function checkAcl($resource, $right)
    {
        $acl  = Zend_Registry::get('acl');
        $role = $this->view->getRole();
        if (!$acl->has($resource)) {
            return true;
        }
        return $acl->isAllowed($role, $resource, $right);
    }
}
