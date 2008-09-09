<?php
// Call ErrorControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "ErrorControllerTest::main");
}

require_once dirname(__FILE__) . '/../TestHelper.php';

/**
 * Test class for Error.
 *
 * @group Controllers
 */
class ErrorControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("ErrorControllerTest");
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
        include dirname(__FILE__) . '/../../scripts/loadTestDb.php';
        $this->bootstrap = Zend_Registry::get('testBootstrap');
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

    public function testErrorControllerTrapsMissingActionsAs404s()
    {
        $this->dispatch('/paste/bogus');
        $this->assertResponseCode(404);
        $this->assertController('error');
        $this->assertAction('error');
    }

    public function testErrorControllerTrapsMissingControllersAs404s()
    {
        $this->dispatch('/bogus');
        $this->assertResponseCode(404);
        $this->assertController('error');
        $this->assertAction('error');
    }

    public function testErrorControllerTrapsExceptionsAs500s()
    {
        $this->markTestSkipped('Still trying to determine a scenario to test this');
    }
}

// Call ErrorControllerTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "ErrorControllerTest::main") {
    ErrorControllerTest::main();
}
