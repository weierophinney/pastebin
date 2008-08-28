<?php
/** Zend_Dojo_View_Helper_Dijit */
require_once 'Zend/Dojo/View/Helper/Dijit.php';

/**
 * dijit.form.SimpleTextarea view helper
 * 
 * @uses       Zend_Dojo_View_Helper_Dijit
 * @category   My
 * @package    My_View
 * @subpackage Helper
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_View_Helper_SimpleTextarea extends Zend_Dojo_View_Helper_Dijit
{
    /**
     * @var string Dijit type
     */
    protected $_dijit  = 'dijit.form.SimpleTextarea';

    /**
     * @var string HTML element type
     */
    protected $_elementType = 'textarea';

    /**
     * @var string Dojo module
     */
    protected $_module = 'dijit.form.SimpleTextarea';

    /**
     * dijit.form.SimpleTextarea
     * 
     * @param  string $id 
     * @param  string $value 
     * @param  array $params  Parameters to use for dijit creation
     * @param  array $attribs HTML attributes
     * @return string
     */
    public function simpleTextarea($id, $value = null, array $params = array(), array $attribs = array())
    {
        if (!array_key_exists('id', $attribs)) {
            $attribs['id']    = $id;
        }
        $attribs['name']  = $id;
        $attribs['type']  = $this->_elementType;

        $attribs = $this->_prepareDijit($attribs, $params, 'textarea');

        $html = '<textarea' . $this->_htmlAttribs($attribs) . '>'
              . $this->view->escape($value)
              . "</textarea>\n";

        return $html;
    }
}
