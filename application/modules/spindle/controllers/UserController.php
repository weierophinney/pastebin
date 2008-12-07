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
        $ajaxContext = $this->_helper->gethelper('ajaxContext');
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

        $resourceLoader = $this->_helper->getHelper('ResourceLoader');
        $this->model    = $resourceLoader->getModel('user');

        $this->view->loginForm = $resourceLoader->getForm('Login');
        $this->view->loginForm
             ->setMethod('post')
             ->setAction($this->view->url(
                 array(
                     'module'     => 'spindle',
                     'controller' => 'user',
                     'action'     => 'login',
                 ),
                 'default',
                 true
               ));

        $this->view->registrationForm = $resourceLoader->getForm('Register');
        $this->view->registrationForm
             ->setMethod('post')
             ->setAction($this->view->url(
                 array(
                     'module'     => 'spindle',
                     'controller' => 'user',
                     'action'     => 'register',
                 ),
                 'default',
                 true
               ));
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

        $this->view->isJson = false;
        if ($this->_helper->ajaxContext->getCurrentContext()) {
            $this->view->isJson = true;
        }

        // Get our form and validate it
        $form = $this->view->loginForm;
        if (!$form->isValid($request->getPost())) {
            // Invalid entries
            return $this->render('index'); // re-render the login form
        }

        // Setup our authentication adapter and check credentials
        $this->model->setIdentity($form->getValue('username'))
                    ->setCredentials($form->getValue('password'));
        $auth    = Zend_Auth::getInstance();
        $result  = $auth->authenticate($this->model);
        if (!$result->isValid()) {
            // Invalid credentials
            $form->setDescription('Invalid credentials provided')
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
        $form = $this->view->registrationForm;
        if (!$id = $this->model->save($request->getPost(), 'Register')) {
            return $this->render('index'); // re-render the login form
        }

        // Authenticate and persist user identity
        $userRow = $this->model->fetchUser($id);
        $user    = array(
            'id'           => $userRow->id,
            'username'     => $userRow->username,
            'fullname'     => $userRow->fullname,
            'email'        => $userRow->email,
            'date_created' => $userRow->date_created,
        );
        Zend_Auth::getInstance()->getStorage()->write((object) $user);

        $this->_helper->redirector('view');
    }
}
