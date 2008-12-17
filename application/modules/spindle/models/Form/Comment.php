<?php
class Spindle_Model_Form_Comment extends Zend_Dojo_Form
{
    public function init()
    {
        $this->addPrefixPath('My_Form_Element', 'My/Form/Element/', 'element');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $this->addElement('SimpleTextarea', 'comment', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Comment:',
        ));

        $this->addElement('hidden', 'user_id', array(
            'filters'    => array('StringTrim'),
            'validators' => array('Int'),
            'required'   => true,
        ));

        $this->addElement('hidden', 'path', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('Regex', true, array('#^(/[a-z0-9_-]+)+$#i')),
            ),
            'required'   => true,
        ));

        $this->addElement('SubmitButton', 'submit', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Submit Comment',
        ));
    }
}
