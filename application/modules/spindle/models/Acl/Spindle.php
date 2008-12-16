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
    protected $_privilegesGuest = array(
        'view',
        'list',
    );

    protected $_privilegesUser = array(
        'comment',
        'save',
        'link',
    );

    protected $_privilegesDeveloper = array(
        'resolve',
        'close',
        'delete',
    );

    public function __construct()
    {
        $this->add(new Spindle_Model_Acl_Resource_Bug)
             ->addRole(new Spindle_Model_Acl_Role_Guest)
             ->addRole(new Spindle_Model_Acl_Role_User,      'guest')
             ->addRole(new Spindle_Model_Acl_Role_Developer, 'user')
             ->addRole(new Spindle_Model_Acl_Role_Manager,   'developer')
             ->deny()
             ->allow('guest',     'bug', $this->_privilegesGuest)
             ->allow('user',      'bug', $this->_privilegesUser)
             ->allow('developer', 'bug', $this->_privilegesDeveloper);
    }
}
