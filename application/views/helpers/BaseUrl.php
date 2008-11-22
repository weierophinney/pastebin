<?php
/**
 * Helper for retrieving base URL
 * 
 * @uses      Zend_View_Helper_Abstract
 * @package   Paste
 * @author    Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @copyright Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @license   New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version   $Id: $
 */
class Zend_View_Helper_BaseUrl extends Zend_View_Helper_Abstract
{
    /**
     * @var string
     */
    protected $_baseUrl;

    /**
     * Return base URL of application
     * 
     * @return string
     */
    public function baseUrl()
    {
        if (null === $this->_baseUrl) {
            if (isset($this->view->baseUrl)) {
                $this->_baseUrl = $this->view->baseUrl;
            } else {
                $request = Zend_Controller_Front::getInstance()->getRequest();
                $this->_baseUrl = $request->getBaseUrl();
            }
        }

        return $this->_baseUrl;
    }
}
