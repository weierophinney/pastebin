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
        $this->model = new Spindle_Model_Bug;
        $auth        = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->model->setIdentity($identity);
            $this->userId = $identity->id;
        } else {
            $this->model->setIdentity(null);
        }


        $this->view->model = $this->model;
        $this->view->headTitle()->prepend('Bugs');
        $this->view->dojo()->enable();
        $this->view->placeholder('nav')->append(
            $this->view->render('bug/_nav.phtml')
        );
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

        $bug = $this->model->fetchBug($id);
        if (null === $bug) {
            return $this->render('not-found');
        }

        $commentForm = $this->getCommentForm();
        $commentForm->bug_id->setValue($bug->id);
        $commentForm->user_id->setValue($this->userId);
        $this->view->bug = $bug;
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

        if (!($bugId = $this->_getParam('bug_id'))) {
            return $this->_helper->redirector('list');
        }

        $form = $this->getCommentForm();
        if (!$form->isValid($request->getPost())) {
            $request->setParam('id', $bugId);
            return $this->viewAction();
        }

        $model = $this->_helper->resourceLoader->getModel('comment');
        $id = $model->save($form->getValues());
        if (null === $id) {
            throw new Exception('Unexpected error saving comment');
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

    public function getCommentForm()
    {
        if (!isset($this->view->commentForm)) {
            $this->view->commentForm  = new Spindle_Model_Form_Comment(array(
                'method' => 'post',
                'action' => $this->view->url(
                    array(
                        'module'     => 'spindle',
                        'controller' => 'bug',
                        'action'     => 'comment',
                    ),
                    'default',
                    true
                ), 
            ));
            $userId = $this->view->commentForm->user_id;
            $userId->addValidator('Identical', true, array($this->userId));
        }
        return $this->view->commentForm;
    }
}
