<?php
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'controllers_AllTests::main');
}

/**
 * Test helper
 */
require_once dirname(__FILE__) . '/../TestHelper.php';

require_once 'controllers/PasteControllerTest.php';

class controllers_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Paste Application - controllers');

        $suite->addTestSuite('controllers_PasteControllerTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'controllers_AllTests::main') {
    controllers_AllTests::main();
}
