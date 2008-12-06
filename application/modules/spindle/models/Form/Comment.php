<?php
class Spindle_Model_Form_Comment extends Zend_Dojo_Form
{
    public function init()
    {
        $this->addPrefixPath('My_Form_Element', 'My/Form/Element/', 'element');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $comment = $this->addElement('SimpleTextarea', 'comment', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Comment:',
        ));

        $userId = $this->addElement('hidden', 'user_id', array(
            'filters'    => array('StringTrim'),
            'validators' => array('Int'),
            'required'   => true,
        ));

        $bugId = $this->addElement('hidden', 'bug_id', array(
            'filters'    => array('StringTrim'),
            'validators' => array('Int'),
            'required'   => true,
        ));

        $submit = $this->addElement('SubmitButton', 'submit', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Submit Comment',
        ));
    }
}
