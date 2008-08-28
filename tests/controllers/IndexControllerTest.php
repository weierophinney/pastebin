<?php
// Call controllers_IndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "controllers_IndexControllerTest::main");
}

require_once dirname(__FILE__) . '/../TestHelper.php';

/**
 * Test class for Index controller
 */
class controllers_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("controllers_IndexControllerTest");
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
        $this->bootstrap = array($this, 'bootstrapPaste');
        return parent::setUp();
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

    public function bootstrapPaste()
    {
        include dirname(__FILE__) . '/../../scripts/loadTestDb.php';
        $this->frontController->registerPlugin(new My_Plugin_Initialize(dirname(__FILE__) . '/../../', 'testing'));
    }

    public function testIndexAction() 
    { 
        $this->request->setQuery('mr', 'proper')
                      ->setQuery('james', 'bond');
        $this->dispatch('/index/index');
        $this->fail(var_export($this->request->getQuery(), 1));
    }
}

// Call controllers_IndexControllerTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "controllers_IndexControllerTest::main") {
    controllers_IndexControllerTest::main();
}
