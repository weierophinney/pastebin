<?php
/**
 * Pastebin application
 * 
 * @uses      Zend_Controller_Action
 * @package   Paste
 * @license   New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version   $Id: $
 */
class PasteController extends Zend_Controller_Action
{
    /**
     * @var Paste
     */
    protected $_model;

    /**
     * Pre-Dispatch: set up dojo and context switching
     * 
     * @return void
     */
    public function preDispatch()
    {
        $request = $this->getRequest();

        $message = array(
            'Current request information',
            array(
                array('Module', 'Controller', 'Action'),
                array($request->getModuleName(), $request->getControllerName(), $request->getActionName()),
            )
        );

        Zend_Registry::get('log')->table($message);
    }

    /**
     * Landing page
     * 
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * New Paste page
     * 
     * @return void
     */
    public function newAction()
    {
        $this->view->model = $this->getModel();
    }

    /**
     * Save paste
     * 
     * @return void
     */
    public function saveAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('new');
        }

        $model = $this->getModel();
        if (false === ($id = $model->add($request->getPost()))) {
            $this->view->model = $model;
            return $this->render('new');
        }

        $this->_helper->redirector('display', null, null, array('id' => $id));
    }

    /**
     * Display paste
     * 
     * @return void
     */
    public function displayAction()
    {
        if (!$id = $this->_getParam('id', false)) {
            return $this->_helper->redirector('index');
        }

        $this->view->model = $this->getModel();
        $this->view->id    = $id;
        $this->view->title = $id;
    }

    /**
     * Follow-up paste form
     * 
     * @return void
     */
    public function followupAction()
    {
        if (!$id = $this->_getParam('id', false)) {
            return $this->_helper->redirector('index');
        }

        $this->view->model = $this->getModel();
        $this->view->id    = $id;
    }

    /**
     * Process followup
     * 
     * @return void
     */
    public function saveFollowupAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('new');
        }

        if (!$parentId = $this->_getParam('id', false)) {
            return $this->_helper->redirector('index');
        }

        $form = $this->getFollowupForm($parentId);
        if (!$form->isValid($request->getPost($form->getElementsBelongTo()))) {
            $this->view->model = $model;
            $this->view->id    = $parentId;
            return $this->render('followup');
        }

        $data  = $form->getValues();
        $data  = $data[$form->getElementsBelongTo()];
        $model = $this->getModel();
        $id    = $model->add($data);

        $this->_helper->redirector('display', null, null, array('id' => $id));
    }

    /**
     * List active pastes
     * 
     * @return void
     */
    public function activeAction()
    {
    }

    /**
     * Helper method: get paste model 
     * 
     * @return Paste
     */
    public function getModel()
    {
        if (null === $this->_model) {
            $this->_model = new Paste();
        }
        return $this->_model;
    }

    /**
     * Helper method: get new paste form
     * 
     * @return PasteForm
     */
    public function getForm()
    {
        $form   = $this->getModel()->getForm();
        $action = $this->view->url(
            array(
                'controller' => 'paste',
                'action'     => 'save',
            ),
            'default',
            true
        );
        $form->setAction($action)
             ->setMethod('post');
        return $form;
    }

    /**
     * Helper method: get followup paste form
     * 
     * @param  string $id 
     * @return PasteForm
     */
    public function getFollowupForm($id)
    {
        $form   = $this->getForm();
        $action = $this->view->url(
            array(
                'controller' => 'paste',
                'action'     => 'save-followup',
                'id'         => $id,
            ),
            'default',
            true
        );
        $form->addElement('hidden', 'parent', array(
                 'required' => true,
                 'validators' => array(
                     new Zend_Validate_Identical($id),
                 ),
             ))
             ->setName('followupform')
             ->setElementsBelongTo('followupform')
             ->setAction($action);
        return $form;
    }
}
