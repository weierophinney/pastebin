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
        $authenticated = Zend_Auth::getInstance()->hasIdentity();
        $action        = $this->getRequest()->getActionName();
        $acl           = Zend_Registry::get('acl');
        $role          = Zend_Registry::get('role');

        if ($acl->has('bug')) {
            if (!$acl->isAllowed($role, 'bug', $action)) {
                return $this->_forward('list');
            }
        }

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->userId = $auth->getIdentity()->id;
        }

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
        $developer = $this->_getParam('developer', '');
        $reporter  = $this->_getParam('reporter', '');
        $status    = $this->_getParam('status', 'open');

        $status = ucfirst(strtolower($status));
        if (!in_array($status, array('Open', 'Resolved', 'Closed'))) {
            $status = 'Open';
        }

        $method = 'fetch' . $status . 'Bugs';
        if ('' != $developer) {
            $user    = $this->_helper->resourceLoader->getModel('user')->fetchUser($developer);
            if (null !== $user) {
                $method .= 'ByDeveloper';
                $bugs    = $this->_helper->resourceLoader->getModel('bug')->$method($developer);
                $this->view->listType = $status . ' bugs owned by ' . $user->username;
            }
        } elseif ('' != $reporter) {
            $user    = $this->_helper->resourceLoader->getModel('user')->fetchUser($reporter);
            if (null !== $user) {
                $method .= 'ByReporter';
                $bugs    = $this->_helper->resourceLoader->getModel('bug')->$method($developer);
                $this->view->listType = $status . ' bugs reported by ' . $user->username;
            }
        } 

        if (!isset($bugs)) {
            $bugs    = $this->_helper->resourceLoader->getModel('bug')->$method();
            $this->view->listType = $status . ' bugs';
        }

        $this->view->bugs = $bugs;
    }

    public function viewAction()
    {
        if (!($id = $this->_getParam('id', false))) {
            return $this->_helper->redirector('list');
        }

        $bug = $this->_helper->resourceLoader->getModel('bug')->fetchBug($id);
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
        $form = $this->getBugForm();
    }

    public function processAddAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return $this->_helper->redirector('list');
        }

        $form = $this->getBugForm();
        if (!$form->isValid($request->getPost())) {
            // failed
            return $this->render('add');
        }

        $values = $form->getValues();
        $values['reporter_id'] = Zend_Auth::getInstance()->getIdentity()->id;
        $model = $this->_helper->resourceLoader->getModel('bug');
        $id = $model->save($values);
        if (null === $id) {
            throw new Exception('Unexpected error saving bug');
        }

        $this->_helper->redirector('view', 'bug', 'default', array('id' => $id));
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

        $this->_helper->redirector('view', 'bug', 'default', array('id' => $bugId));
    }

    public function deleteAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->render('not-found');
        }

        if (!($id = $this->_getParam('id', false))) {
            return $this->render('not-found');
        }

        $model = $this->_helper->resourceLoader->getModel('bug');
        $model->delete($id);
        return $this->_helper->redirector('list');
    }

    public function cleanupAction()
    {
        $model = $this->_helper->resourceLoader->getModel('bug');
        $model->cleanupTestBugs();
        $this->_helper->redirector('index');
    }

    public function getBugForm()
    {
        if (!isset($this->view->bugForm)) {
            $this->view->bugForm  = $this->_helper->getForm(
                'bug', 
                array(
                    'method' => 'post',
                    'action' => $this->view->url(
                        array(
                            'controller' => 'bug',
                            'action'     => 'process-add',
                        ),
                        'default',
                        true
                    ), 
                )
            );
        }
        return $this->view->bugForm;
    }

    public function getCommentForm()
    {
        if (!isset($this->view->commentForm)) {
            $this->view->commentForm  = $this->_helper->getForm(
                'comment', 
                array(
                    'method' => 'post',
                    'action' => $this->view->url(
                        array(
                            'controller' => 'bug',
                            'action'     => 'comment',
                        ),
                        'default',
                        true
                    ), 
                )
            );
            $userId = $this->view->commentForm->user_id;
            $userId->addValidator('Identical', true, array($this->userId));
        }
        return $this->view->commentForm;
    }
}
