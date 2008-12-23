<?php
/**
 * ACLs
 *
 * ACL definitions for Spindle.
 * 
 * @package    Spindle
 * @subpackage Model_Acl
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Model_Acl_Spindle extends Zend_Acl
{
    public function __construct()
    {
        $this->addRole(new Spindle_Model_Acl_Role_Guest)
             ->addRole(new Spindle_Model_Acl_Role_User,      'guest')
             ->addRole(new Spindle_Model_Acl_Role_Developer, 'user')
             ->addRole(new Spindle_Model_Acl_Role_Manager,   'developer')
             ->deny();
    }
}
