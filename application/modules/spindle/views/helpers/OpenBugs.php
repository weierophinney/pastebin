<?php
class Spindle_View_Helper_OpenBugs extends Zend_View_Helper_Abstract
{
    protected $_model;

    protected $_validUserTypes = array('developer', 'reporter');

    public function openBugs($userId = null, $userType = null)
    {
        if (!in_array($userType, $this->_validUserTypes)) {
            $userType = 'developer';
        }

        if (null === $userId) {
            $bugs = $this->getModel()->fetchOpenBugs();
        } elseif ('reporter' == $userType) {
            $bugs = $this->getModel()->fetchOpenBugsByReporter($userId);
        } else {
            $bugs = $this->getModel()->fetchOpenBugsByDeveloper($userId);
        }

        $html = "<ul class=\"buglist\">\n";
        if (0 == count($bugs)) {
            $html .= "<li><b>No open bugs</b></li>";
        } else {
            foreach ($bugs as $bug) {
                $html .= '<li>'
                    .  $this->view->bugLink($bug->id, $bug->summary)
                    .  "</li>\n";
            }
        }
        $html .= "</ul>\n";
        return $html;
    }

    public function getModel()
    {
        if (null === $this->_model) {
            $this->_model = new Spindle_Model_BugTracker();
        }
        return $this->_model;
    }
}
