<?php
/**
 * IndexController 
 * 
 * @uses      Zend_Controller_Action
 * @package   Spindle
 * @license   New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version   $Id: $
 */
class IndexController extends Zend_Controller_Action
{
    /**
     * Home page; redirect to pastebin landing page
     * 
     * @return void
     */
    public function indexAction()
    {
        $this->_helper->redirector('index', 'paste', 'spindle');
    }
}
