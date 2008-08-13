<?php
class My_View_Helper_Editor extends Zend_Dojo_View_Helper_Textarea
{
    protected $_dijit = 'dijit.Editor';

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
