<?php
class Spindle_View_Helper_BugLink extends Zend_View_Helper_Abstract
{
    public function bugLink($id, $summary)
    {
        return '<a href="' 
            . $this->view->url(
                array(
                    'module'     => 'spindle',
                    'controller' => 'bug', 
                    'action'     => 'view', 
                    'id'         => $id), 
                'default', 
                true) 
            . '">' 
            . $this->view->escape($summary) 
            . '</a>';
    }
}
