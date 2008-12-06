<?php
class Spindle_Model_Form_Login extends Zend_Dojo_Form
{
    public function init()
    {
        $this->addPrefixPath('My_Form_Element', 'My/Form/Element/', 'element');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $username = $this->addElement('ValidationTextBox', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                'Alpha',
                array('StringLength', false, array(3, 20)),
            ),
            'lowercase'  => true,
            'trim'       => true,
            'regExp'     => '^[a-z]{3,20}$',
            'required'   => true,
            'label'      => 'Your username:',
        ));

        $password = $this->addElement('PasswordTextBox', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ),
            'required'   => true,
            'trim'       => true,
            'regExp'     => '^[a-z0-9]{6,20}$',
            'label'      => 'Password:',
        ));

        $login = $this->addElement('SubmitButton', 'login', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Login',
        ));

        // We want to display a 'failed authentication' message if necessary;
        // we'll do that with the form 'description', so we need to add that
        // decorator.
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'dl', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend')),
            'Form'
        ));
    }
}
