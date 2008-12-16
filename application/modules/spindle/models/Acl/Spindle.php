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
    protected $_privilegesBugGuest = array(
        'view',
        'list',
    );

    protected $_privilegesBugUser = array(
        'comment',
        'save',
        'link',
    );

    protected $_privilegesBugDeveloper = array(
        'resolve',
        'close',
        'delete',
    );

    protected $_privilegesCommentGuest = array(
        'list',
    );

    protected $_privilegesCommentUser = array(
        'save',
    );

    protected $_privilegesCommentDeveloper = array(
        'delete',
    );

    public function __construct()
    {
        $this->addRole(new Spindle_Model_Acl_Role_Guest)
             ->addRole(new Spindle_Model_Acl_Role_User,      'guest')
             ->addRole(new Spindle_Model_Acl_Role_Developer, 'user')
             ->addRole(new Spindle_Model_Acl_Role_Manager,   'developer')
             ->deny();

        $this->add(new Spindle_Model_Acl_Resource_Bug)
             ->allow('guest',     'bug', $this->_privilegesBugGuest)
             ->allow('user',      'bug', $this->_privilegesBugUser)
             ->allow('developer', 'bug', $this->_privilegesBugDeveloper);

        $this->add(new Spindle_Model_Acl_Resource_Comment)
             ->allow('guest',     'comment', $this->_privilegesCommentGuest)
             ->allow('user',      'comment', $this->_privilegesCommentUser)
             ->allow('developer', 'comment', $this->_privilegesCommentDeveloper);
    }
}
