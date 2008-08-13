<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->_helper->redirector('index', 'paste');
    }

    public function testEditorAction()
    {
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative();
        $this->view->dojo()->registerModulePath('paste', '../paste')
                           ->requireModule('paste.main')
                           ->addOnLoad('paste.main.init')
                           ->enable();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->view->data = $request->getPost();
            return $this->render('test-complete');
        }

        $form = new Zend_Dojo_Form(array(
            'action'           => '/index/test-editor',
            'method'           => 'post',
            'elementsBelongTo' => 'fooForm',
        ));
        $form->addPrefixPath('My_Form_Element', 'My/Form/Element', 'element');

        $form->addElement('Editor', 'content', array(
            'width' => '200px',
            'value' => "It was a dark and stormy night.  Your story belongs here!",
        ));

        $form->addElement('SubmitButton', 'save', array(
            'label' => 'Save',
        ));

        $this->view->form = $form;
        return $this->render();
    }
}
