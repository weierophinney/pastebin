<?php
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'AllTests::main');
}

/**
 * Test helper
 */
require_once dirname(__FILE__) . '/TestHelper.php';
require_once dirname(__FILE__) . '/controllers/AllTests.php';
require_once dirname(__FILE__) . '/models/AllTests.php';

class AllTests
{
    public static function main()
    {
        $parameters = array();

        if (defined('TESTS_GENERATE_REPORT') 
            && TESTS_GENERATE_REPORT 
            && extension_loaded('xdebug')
        ) {
            $parameters['reportDirectory'] = TESTS_GENERATE_REPORT_TARGET;
        }

        if (defined('TESTS_ZEND_LOCALE_FORMAT_SETLOCALE') && TESTS_ZEND_LOCALE_FORMAT_SETLOCALE) {
            // run all tests in a special locale
            setlocale(LC_ALL, TESTS_ZEND_LOCALE_FORMAT_SETLOCALE);
        }

        PHPUnit_TextUI_TestRunner::run(self::suite(), $parameters);
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Bug Application');

        $suite->addTest(controllers_AllTests::suite());
        $suite->addTest(models_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'AllTests::main') {
    AllTests::main();
}
