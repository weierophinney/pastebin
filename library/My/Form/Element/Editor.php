<?php
/** Zend_Dojo_Form_Element_Dijit */
require_once 'Zend/Dojo/Form/Element/Dijit.php';

/**
 * dijit.Editor
 * 
 * @uses       Zend_Dojo_Form_Element_Dijit
 * @category   My
 * @package    My_Form
 * @subpackage Element
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_Form_Element_Editor extends Zend_Dojo_Form_Element_Dijit
{
    /**
     * @var string View helper
     */
    public $helper = 'Editor';
}
