<?php
class Spindle_IndexController extends Zend_Controller_Action
{
    public function preDispatch()
    {
        $this->view->dojo()->enable();
    }

    public function indexAction()
    {
    }
}
