<?php
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'models_AllTests::main');
}

/**
 * Test helper
 */
require_once dirname(__FILE__) . '/../TestHelper.php';

require_once dirname(__FILE__) . '/PasteTest.php';
require_once dirname(__FILE__) . '/Paste/TableTest.php';

class models_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Paste Application - Models');

        $suite->addTestSuite('models_PasteTest');
        $suite->addTestSuite('models_Paste_TableTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'models_AllTests::main') {
    models_AllTests::main();
}
