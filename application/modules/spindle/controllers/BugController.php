<?php
/**
 * Bugs
 * 
 * @uses       Zend_Controller_Action
 * @package    Spindle
 * @subpackage Controller
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_BugController extends Zend_Controller_Action
{
    public $userId = null;

    public function preDispatch()
    {
        $this->model        = new Spindle_Model_Bug;
        $this->commentModel = new Spindle_Model_Comment;

        $commentsHelper = $this->view->getHelper('comments');
        $commentsHelper->setModel('Comment', $this->commentModel);

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->model->setIdentity($identity);
            $this->commentModel->setIdentity($identity);
            $this->userId = $identity->id;
        } else {
            $this->model->setIdentity(null);
            $this->commentModel->setIdentity(null);
        }


        $this->view->headTitle()->prepend('Bugs');
        $this->view->dojo()->enable();
        $this->view->placeholder('nav')->append(
            $this->view->render('bug/_nav.phtml')
        );

        $this->view->model = $this->model;
    }

    public function indexAction()
    {
        return $this->_forward('list');
    }

    public function listAction()
    {
        $this->view->assign(array(
            'developer' => $this->_getParam('developer', ''),
            'reporter'  => $this->_getParam('reporter', ''),
            'status'    => $this->_getParam('status', 'open'),
            'userModel' => new Spindle_Model_User(),
        ));
    }

    public function viewAction()
    {
        if (!($id = $this->_getParam('id', false))) {
            return $this->_helper->redirector('list');
        }

        $this->view->bug = $this->model->fetchBug($id);
        if (null === $this->view->bug) {
            return $this->render('not-found');
        }
    }

    public function addAction()
    {
        if (!$this->model->checkAcl('save')) {
            $this->_forward('list');
        }
    }

    public function processAddAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->_helper->redirector('list');
        }

        $form = $this->model->getBugForm();
        $form->removeElement('id');
        if (!$id = $this->model->save($request->getPost())) {
            // failed
            return $this->render('add');
        }

        $this->_helper->redirector('view', 'bug', 'spindle', array('id' => $id));
    }

    public function commentAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->_helper->redirector('list');
        }

        if (!($path = $this->_getParam('path'))) {
            return $this->_helper->redirector('list');
        }

        $segments = explode('/', $path);
        $bugId    = array_pop($segments);

        if (!$id = $this->commentModel->save($request->getPost())) {
            $request->setParam('id', $bugId);
            $this->_helper->viewRenderer->setScriptAction('view');
            $this->viewAction();
            return;
        }

        $this->_helper->redirector('view', 'bug', 'spindle', array('id' => $bugId));
    }

    public function deleteAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->render('not-found');
        }

        if (!($id = $this->_getParam('id', false))) {
            return $this->render('not-found');
        }

        if (!$this->model->delete($id)) {
            $this->message = "Insufficient permissions to delete issues.";
            return $this->render('error');
        }
        return $this->_helper->redirector('list');
    }

    public function cleanupAction()
    {
        $this->model->cleanupTestBugs();
        $this->_helper->redirector('index');
    }
}
