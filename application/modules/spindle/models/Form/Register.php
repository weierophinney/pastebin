<?php
class Spindle_Model_Form_Register extends Zend_Dojo_Form
{
    public function init()
    {
        $this->addPrefixPath('My_Form_Element', 'My/Form/Element/', 'element');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $helper = Zend_Controller_Action_HelperBroker::getStaticHelper('ResourceLoader');
        $user   = $helper->getModel('UserManager'); // mainly ensure it's loaded, for validation'

        $this->addElementPrefixPath('Spindle_Model_Validate', dirname(__FILE__) . '/../Validate', 'validate');

        $this->setElementsBelongTo('register')
             ->setName('register');

        $username = $this->addElement('ValidationTextBox', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                'Alpha',
                array('StringLength', true, array(3, 20)),
                array('UniqueUsername', false, array($user)),
            ),
            'required'   => true,
            'lowercase'  => true,
            'trim'       => true,
            'regExp'     => '^[a-z]{3,20}$',
            'label'      => 'Desired username:',
        ));

        $fullname = $this->addElement('ValidationTextBox', 'fullname', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(3, 60)),
            ),
            'required'   => false,
            'trim'       => true,
            'label'      => 'Your full name:',
        ));

        $email = $this->addElement('ValidationTextBox', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('EmailAddress', true),
                array('UniqueUsername', true, array($user)),
            ),
            'required'   => false,
            'trim'       => true,
            'regExp'     => "\\b['a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}\\b",
            'label'      => 'Your email address:',
        ));

        $password = $this->addElement('PasswordTextBox', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ),
            'required'   => true,
            'trim'       => true,
            'regExp'     => '^[a-zA-Z0-9]{6,20}$',
            'label'      => 'Password:',
        ));

        $passwordVerification = $this->addElement('PasswordTextBox', 'passwordVerification', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'PasswordVerification'
            ),
            'required'   => true,
            'trim'       => true,
            'label'      => 'Password Verification:',
        ));

        $register = $this->addElement('SubmitButton', 'register', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Register',
        ));
    }
}
