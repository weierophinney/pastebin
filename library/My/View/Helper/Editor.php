<?php
/** Zend_Dojo_View_Helper_Textarea */
require_once 'Zend/Dojo/View/Helper/Textarea.php';

/**
 * dijit.Editor view helper
 * 
 * @uses       Zend_Dojo_View_Helper_Textarea
 * @category   My
 * @package    My_View
 * @subpackage Helper
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_View_Helper_Editor extends Zend_Dojo_View_Helper_Textarea
{
    /**
     * @param string Dijit type
     */
    protected $_dijit = 'dijit.Editor';

    /**
     * dijit.Editor
     * 
     * @param  string $id 
     * @param  string $value 
     * @param  array $params 
     * @param  array $attribs 
     * @return string
     */
    public function editor($id, $value = null, $params = array(), $attribs = array())
    {
        $hiddenName = $textareaName = $id;

        $hiddenAttribs = array(
            'id'    => $hiddenName,
            'name'  => $hiddenName,
            'value' => $value,
            'type'  => 'hidden',
        );

        if (array_key_exists('id', $attribs)) {
            $hiddenAttribs['id'] = $attribs['id'];
            $attribs['id'] .= 'Editor';
            $id = $attribs['id'];
        }

        if (']' == $textareaName[strlen($textareaName) - 1]) {
            $textareaName = rtrim($textareaName, ']');
            $textareaName .= 'Editor]';
        }

        $this->_createGetParentFormFunction();
        $this->_createEditorOnSubmit($hiddenAttribs['id'], $id);

        $html = '<input' . $this->_htmlAttribs($hiddenAttribs) . $this->getClosingBracket()
              . $this->textarea($textareaName, $value, $params, $attribs);
        return $html;
    }

    /**
     * Create JS function for retrieving parent form
     * 
     * @return void
     */
    protected function _createGetParentFormFunction()
    {
        $function =<<<EOJ
if (zend == undefined) {
    var zend = {};
}
zend.findParentForm = function(elementNode) {
    while (elementNode.nodeName.toLowerCase() != 'form') {
        elementNode = elementNode.parentNode;
    }
    return elementNode;
};
EOJ;

        $this->dojo->addJavascript($function);
    }

    /**
     * Create onSubmit binding for element
     * 
     * @param  string $hiddenId 
     * @param  string $editorId 
     * @return void
     */
    protected function _createEditorOnSubmit($hiddenId, $editorId)
    {
        $this->dojo->onLoadCaptureStart();
        echo <<<EOJ
function() {
    var form = zend.findParentForm(dojo.byId('$hiddenId'));
    dojo.connect(form, 'onsubmit', function () {
        dojo.byId('$hiddenId').value = dijit.byId('$editorId').getValue(false);
    });
}
EOJ;
        $this->dojo->onLoadCaptureEnd();
    }
}
