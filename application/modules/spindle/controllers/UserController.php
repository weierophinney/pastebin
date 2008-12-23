<?php
/**
 * User management
 * 
 * @uses       Zend_Controller_Action
 * @package    Spindle
 * @subpackage Controller
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_UserController extends Zend_Controller_Action
{
    public function preDispatch()
    {
        $ajaxContext = $this->_helper->getHelper('ajaxContext');
        $ajaxContext->addActionContext('index', 'html')
                    ->addActionContext('login', 'json')
                    ->addActionContext('register', 'json')
                    ->setAutoJsonSerialization(false);
        $ajaxContext->initContext($this->_getParam('format'));

        if (Zend_Auth::getInstance()->hasIdentity()) {
            if (!in_array($this->getRequest()->getActionName(), array('logout', 'view'))) {
                $this->_helper->redirector('view');
            }
        } else {
            if (!in_array($this->getRequest()->getActionName(), array('index', 'register', 'login'))) {
                $this->_helper->redirector('index');
            }
        }

        $this->view->headTitle()->prepend('User');
        $this->view->dojo()->enable();

        $this->view->model = $this->model = new Spindle_Model_UserManager;
    }

    public function indexAction()
    {
    }

    public function loginAction()
    {
        $request = $this->getRequest();

        // Check if we have a POST request
        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }

        if (!$credentials = $request->getPost('login', false)) {
            return $this->_helper->redirector('index');
        }

        // Setup our authentication adapter and check credentials
        Phly_PubSub::publish('log', "Validating credentials: ". var_export($credentials, 1));
        $user   = $this->model->create($credentials);
        $auth   = Zend_Auth::getInstance();
        $result = $auth->authenticate($user);
        if (!$result->isValid()) {
            // Invalid credentials
            $this->model->getLoginForm()
                 ->setDescription('Invalid credentials provided')
                 ->addErrorMessage('Invalid credentials provided');
            return $this->render('index'); // re-render the login form
        }

        // We're authenticated! Redirect to the user page
        if (null !== $this->_helper->ajaxContext->getCurrentContext()) {
            $this->view->identity = $result->getIdentity();
            return $this->render('login');
        }

        $this->_helper->redirector('view');
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index');
    }

    public function viewAction()
    {
        $user = Zend_Auth::getInstance()->getIdentity();
        $this->view->user = $user;
    }

    public function registerAction()
    {
        $request = $this->getRequest();

        // Check if we have a POST request
        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }

        // Get our form and validate it
        if (!$id = $this->model->save($request->getPost(), 'Register')) {
            $this->view->form = $this->model->getRegistrationForm();
            return $this->render('index'); // re-render the login form
        }

        // Authenticate and persist user identity
        $user = $this->model->fetchUser($id);
        Zend_Auth::getInstance()->getStorage()->write((object) $user);

        if (null !== $this->_helper->ajaxContext->getCurrentContext()) {
            $this->view->identity = (object) $user;
            return $this->render('login');
        }

        $this->_helper->redirector('view');
    }
}
