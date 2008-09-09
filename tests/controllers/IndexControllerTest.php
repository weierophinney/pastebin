<?php
// Call IndexControllerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "IndexControllerTest::main");
}

require_once dirname(__FILE__) . '/../TestHelper.php';

/**
 * Test class for Index controller
 *
 * @group Controllers
 */
class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("IndexControllerTest");
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

    public function testLandingPageShouldRedirectToPasteLandingPage() 
    { 
        $this->dispatch('/');
        $this->assertRedirectRegex('#/paste(/index)?$#');
    }
}

// Call IndexControllerTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "IndexControllerTest::main") {
    IndexControllerTest::main();
}
