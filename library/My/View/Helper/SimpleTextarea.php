<?php
class My_View_Helper_SimpleTextarea extends Zend_Dojo_View_Helper_Dijit
{
    /**
     * Dijit being used
     * @var string
     */
    protected $_dijit  = 'dijit.form.SimpleTextarea';

    /**
     * HTML element type
     * @var string
     */
    protected $_elementType = 'textarea';

    /**
     * Dojo module to use
     * @var string
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
