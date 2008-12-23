<?php
class Spindle_Model_Form_Bug extends Zend_Dojo_Form
{
    public function init()
    {
        $this->addPrefixPath('My_Form_Element', 'My/Form/Element/', 'element');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $helper = Zend_Controller_Action_HelperBroker::getStaticHelper('ResourceLoader');
        $model  = $helper->getModel('BugTracker');

        $priorities = $model->getPriorities();
        $types      = $model->getTypes();

        $this->addElement('ValidationTextBox', 'summary', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(0, 255)),
            ),
            'required'   => true,
            'trim'       => true,
            'label'      => 'Summary:',
        ));

        $this->addElement('FilteringSelect', 'type_id', array(
            'required'     => true,
            'multiOptions' => $types,
            'label'        => 'Issue Type:',
        ));

        $this->addElement('FilteringSelect', 'priority_id', array(
            'required'     => true,
            'multiOptions' => $priorities,
            'label'        => 'Priority:',
        ));

        $this->addElement('SimpleTextarea', 'description', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Bug Description:',
        ));

        $this->addElement('SubmitButton', 'report', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Report Issue',
        ));

        $this->addElement('hidden', 'id', array(
            'required'   => false,
            'decorators' => array('ViewHelper'),
        ));
    }
}
