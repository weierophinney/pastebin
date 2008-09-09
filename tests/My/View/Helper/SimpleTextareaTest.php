<?php
// Call My_View_Helper_SimpleTextareaTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "My_View_Helper_SimpleTextareaTest::main");
}

require_once dirname(__FILE__) . '/../../../TestHelper.php';

/** My_View_Helper_SimpleTextarea */
require_once 'My/View/Helper/SimpleTextarea.php';

/**
 * Test class for SimpleTextarea dijit view helper.
 *
 * @group My
 * @group View_Helper
 */
class My_View_Helper_SimpleTextareaTest extends PHPUnit_Framework_TestCase 
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("My_View_Helper_SimpleTextareaTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $registry = Zend_Registry::getInstance();
        if (isset($registry['Zend_Dojo_View_Helper_Dojo'])) {
            unset($registry['Zend_Dojo_View_Helper_Dojo']);
        }
        Zend_Dojo_View_Helper_Dojo::setUseProgrammatic(true);
        $view = new Zend_View;
        Zend_Dojo::enableView($view);
        $this->helper = new My_View_Helper_SimpleTextarea();
        $this->helper->setView($view);
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
    }

    public function testDeclarativeUseShouldCreateTextareaWithSimpleTextareaDojoType()
    {
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative(true);
        $html = $this->helper->simpleTextarea('foo', 'seeded text');
        $this->assertContains('id="foo"', $html);
        $this->assertContains('<textarea', $html);
        $this->assertContains('dojoType="dijit.form.SimpleTextarea"', $html);
    }

    public function testProgrammaticUseShouldCreateTextareaWithSimpleTextareaDojoType()
    {
        $html = $this->helper->simpleTextarea('foo', 'seeded text');
        $this->assertContains('id="foo"', $html);
        $this->assertContains('<textarea', $html);
        $this->assertNotContains('dojoType="dijit.form.SimpleTextarea"', $html);
        $this->assertTrue($this->helper->view->dojo()->hasDijit('foo'));
        $modules = $this->helper->view->dojo()->getModules();
        $this->assertTrue(in_array('dijit.form.SimpleTextarea', $modules));
    }
}

// Call My_View_Helper_SimpleTextareaTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "My_View_Helper_SimpleTextareaTest::main") {
    My_View_Helper_SimpleTextareaTest::main();
}
