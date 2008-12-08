<?php
class Spindle_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    protected $_acl;

    /**
     * Dispatch loop startup plugin: get identity and acls
     * 
     * @param Zend_Controller_Request_Abstract $request 
     * @return void
     */
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->view = Zend_Layout::getMvcInstance()->getView();
        $auth       = Zend_Auth::getInstance();
        $identity   = array();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $role = empty($identity->role) ? 'user' : $identity->role;
        } else {
            $role = 'guest';
        }

        if (!empty($identity)) {
            $jsonIdentity = Zend_Json::encode($identity);
            $this->view->dojo()->addOnLoad('function(){
                spindle.statusBar.setStatusIdentity(' . $jsonIdentity . ');
            }');
        }

        $this->view->assign('identity', $identity);
        // Zend_Registry::set('acl', $this->getAcl());
        // Zend_Registry::set('role', $role);
    }

    /**
     * Get ACL lists
     * 
     * @return Zend_Acl
     */
    public function getAcl()
    {
        if (null === $this->_acl) {
            $acl = new Zend_Acl();
            $this->_loadAclClasses();
            $acl->add(new Bugapp_Acl_Resource_Bug)
                ->addRole(new Bugapp_Acl_Role_Guest)
                ->addRole(new Bugapp_Acl_Role_User, 'guest')
                ->addRole(new Bugapp_Acl_Role_Developer, 'user')
                ->addRole(new Bugapp_Acl_Role_Manager, 'developer')
                ->deny()
                ->allow('guest', 'bug', array('view', 'list', 'index'))
                ->allow('user', 'bug', array('comment', 'add', 'process-add'))
                ->allow('developer', 'bug', array('resolve'))
                ->allow('developer', 'bug', array('close', 'delete'));
            $this->_acl = $acl;
        }
        return $this->_acl;
    }

    /**
     * Load ACL classes from module models directory
     * 
     * @return void
     */
    protected function _loadAclClasses()
    {
        $loader = new Zend_Loader_PluginLoader(array(
            'Bugapp_Acl_Role'     => APPLICATION_PATH . '/models/Acl/Role/',
            'Bugapp_Acl_Resource' => APPLICATION_PATH . '/models/Acl/Resource/',
        ));
        foreach (array('Guest', 'User', 'Developer', 'Manager') as $role) {
            $loader->load($role);
        }
        foreach (array('Bug') as $resource) {
            $loader->load($resource);
        }
    }
}
