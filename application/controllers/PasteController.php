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

        Zend_Dojo_View_Helper_Dojo::setUseDeclarative();
        $contextSwitch = $this->_helper->contextSwitch;
        if (!$contextSwitch->hasContext('ajax')) {
            $contextSwitch->addContext('ajax', array('suffix' => 'ajax'))
                        ->addActionContext('new', 'ajax')
                        ->addActionContext('followup', 'ajax')
                        ->addActionContext('display', 'ajax')
                        ->addActionContext('active', 'ajax')
                        ->addActionContext('active-data', 'ajax')
                        ->addActionContext('active-data-count', 'ajax')
                        ->initContext();
        }

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
        $form = $this->getForm();
        $this->view->form = $form;
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
            $this->view->form = $model->getForm();
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

        $model = $this->getModel();
        if (!$paste = $model->get($id)) {$view = Zend_Layout::getMvcInstance()->getView();
            $this->view->title   = 'Not Found';
            $this->view->message = "Paste not found";
            return;
        }

        $this->view->id    = $id;
        $this->view->title = $id;
        $this->view->paste = $paste;
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

        $model = $this->getModel();
        if (!$paste = $model->get($id)) {
            $this->view->title   = 'Not Found';
            $this->view->message = "Paste not found";
            return;
        }
        $this->view->id = $id;

        $followupKeys = array(
            'code'    => null,
            'type'    => null,
            'summary' => null,
        );
        $followup = array_intersect_key($paste, $followupKeys);
        $followup['parent'] = $id;

        $form = $this->getFollowupForm($id);
        $form->setDefaults($followup);

        $this->view->title = 'Followup: ' . $id;
        $this->view->form  = $form;
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
            $this->view->form  = $form;
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
     * Retrieve data representing active pastes
     * 
     * @return void
     */
    public function activeDataAction()
    {
        if ('ajax' != $this->_helper->contextSwitch->getCurrentContext()) {
            $this->_helper->redirector('index');
        }

        $this->_helper->layout->disableLayout(true);
        $model = $this->getModel();
        $dojoData = new Zend_Dojo_Data('id', $model->fetchActive($this->getRequest()->getQuery()), 'id');
        $this->view->data = $dojoData;
        $this->view->count = $model->fetchActiveCount();
    }

    /**
     * Return count of active pastes
     * 
     * @return void
     */
    public function activeDataCountAction()
    {
        if ('ajax' != $this->_helper->contextSwitch->getCurrentContext()) {
            $this->_helper->redirector('index');
        }

        $model = $this->getModel();
        $this->view->count = $model->fetchActiveCount();
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
        $form = $this->getModel()->getForm();
        $form->setAction('/paste/save')
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
        $form = $this->getForm();
        $form->addElement('hidden', 'parent', array(
                 'required' => true,
                 'validators' => array(
                     new Zend_Validate_Identical($id),
                 ),
             ))
             ->setName('followupform')
             ->setElementsBelongTo('followupform')
             ->setAction('/paste/save-followup/id/' . $id);
        $form->save->setDijitParam('onClick', 'paste.main.followupPasteButton');
        return $form;
    }
}
