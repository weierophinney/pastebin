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
        $ac = $this->_helper->getHelper('AjaxContext');
        $ac->addActionContext('add', 'html');
        $ac->initContext($this->_getParam('format'));

        $this->model        = new Spindle_Model_BugTracker;
        $this->commentModel = new Spindle_Model_CommentGateway;

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->identity = $auth->getIdentity();
            $this->model->setIdentity($this->identity);
            $this->commentModel->setIdentity($this->identity);
            $this->userId = $this->identity->id;
        } else {
            $this->model->setIdentity(null);
            $this->commentModel->setIdentity(null);
        }

        $this->view->headTitle()->prepend('Bugs');
        $this->view->dojo()->requireModule('bug.main')
                           ->addStylesheetModule('bug.themes.bug')
                           ->enable();
        $this->view->placeholder('nav')->append(
            $this->view->render('bug/_nav.phtml')
        );

        $commentsHelper = $this->view->getHelper('comments');
        $commentsHelper->setModel('CommentGateway', $this->commentModel);

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
            'page'      => $this->_getParam('page', 1),
            'userModel' => new Spindle_Model_UserGateway(),
        ));
    }

    public function viewAction()
    {
        if (!($id = $this->_getParam('id', false))) {
            return $this->_helper->redirector('list');
        }

        if (!$this->view->bug = $this->model->fetch($id)) {
            return $this->render('not-found');
        }
    }

    public function addAction()
    {
        if (!$this->model->checkAcl('save')) {
            return $this->_forward('list');
        }
    }

    public function processAddAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->_helper->redirector('list');
        }

        $bug  = $this->model->fetch();
        $form = $bug->getForm();
        $form->removeElement('id');
        if (!$id = $bug->save($request->getPost())) {
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

        $comment = new Spindle_Model_Comment(array(), array(
            'identity' => $this->identity,
        ));
        if (!$id = $comment->save($request->getPost())) {
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

        $bug = $this->model->fetch($id);

        if (!$bug->delete()) {
            $this->message = "Insufficient permissions to delete issues or database error.";
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
