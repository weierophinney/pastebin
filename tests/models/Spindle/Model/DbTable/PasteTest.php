<?php
// Call Spindle_Model_DbTable_PasteTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Spindle_Model_DbTable_PasteTest::main");
}

require_once dirname(__FILE__) . '/../../../../TestHelper.php';

/** Spindle_Model_DbTable_Paste */
require_once APPLICATION_PATH . '/modules/spindle/models/DbTable/Paste.php';

/**
 * Test class for Spindle_Model_DbTable_Paste.
 *
 * @group Spindle
 * @group Paste
 * @group Models
 */
class Spindle_Model_DbTable_PasteTest extends PHPUnit_Framework_TestCase 
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Spindle_Model_DbTable_PasteTest");
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
        include dirname(__FILE__) . '/../../../../../scripts/loadTestDb.php';
        $this->table = new Spindle_Model_DbTable_Paste();
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

    public function getData()
    {
        return array(
            'code'    => '<?php phpinfo() ?>',
            'type'    => 'php',
            'user'    => 'matthew',
            'summary' => 'test entry',
            'expires' => 3600,
        );
    }

    public function testNewPastesShouldReceiveUniqueIdentifier()
    {
        $id1 = $this->table->insert($this->getData());
        $id2 = $this->table->insert($this->getData());
        $this->assertNotEquals($id1, $id2);
    }

    public function testNewPastesShouldSetCreatedTimestamp()
    {
        $id1    = $this->table->insert($this->getData());
        $record = $this->table->find($id1)->current();
        $this->assertTrue(!empty($record->created));
    }

    public function testNewPasteShouldTranslateIntegerExpiryToDateStampWhenLessThanCurrentDate()
    {
        $id1    = $this->table->insert($this->getData());
        $record = $this->table->find($id1)->current();
        $created = strtotime($record->created);
        $expires = strtotime($record->expires);
        $this->assertEquals(3600, $expires - $created);
    }

    public function testNewPasteShouldVerifyExpiryIsInFutureWhenProvidedAsString()
    {
        $data    = $this->getData();
        $current = date('Y-m-d H:i:s');
        $data['expires'] = date('Y-m-d H:i:s', time() - 3600);
        $id1     = $this->table->insert($data);
        $record  = $this->table->find($id1)->current();
        $this->assertTrue($current < strtotime($record->expires));
    }

    public function testNewPasteShouldOmitExpiryWhenProvidedInvalidDataType()
    {
        $data   = $this->getData();
        $data['expires'] = false;
        $id1    = $this->table->insert($data);
        $record = $this->table->find($id1)->current();
        $this->assertTrue(empty($record->expires), 'Expires: ' . var_export($record->expires, 1));
    }

    /**
     * @expectedException Spindle_Model_Exception
     */
    public function testTableShouldNotAllowUpdates()
    {
        $id1    = $this->table->insert($this->getData());
        $record = $this->table->find($id1)->current();
        $record->code = '<?php echo "foobar\n"; ?>';
        $record->save();
    }

    /**
     * @expectedException Spindle_Model_Exception
     */
    public function testTableShouldNotAllowDeletes()
    {
        $id1    = $this->table->insert($this->getData());
        $record = $this->table->find($id1)->current();
        $record->delete();
    }

    public function testInsertingDataShouldAllowStringExpireDates()
    {
        $data = $this->getData();
        $data['expires'] = date('Y-m-d H:i:s', time() + 3600);
        $id = $this->table->insert($data);
        $record = $this->table->find($id)->current();
        $this->assertFalse(empty($record->expires));
    }

    public function testExpiryShouldNotBeSetIfStringExpiresIsInPast()
    {
        $this->markTestSkipped("Noticing oddities with timestamp calculations in sqlite");
        $data = $this->getData();
        $data['expires'] = date('Y-m-d H:i:s', time() - (60 * 60 * 7 * 4));
        $id = $this->table->insert($data);
        $record = $this->table->find($id)->current();
        $this->assertTrue(empty($record->expires), "Inserting {$data['expires']} resulted in {$record->expires}");
    }

    public function testNoExpiryShouldBeSetForInvalidExpiryFormat()
    {
        $data = $this->getData();
        $data['expires'] = array(time());
        $id = $this->table->insert($data);
        $record = $this->table->find($id)->current();
        $this->assertTrue(empty($record->expires), "Inserting array resulted in {$record->expires}");
    }
}

// Call Spindle_Model_DbTable_PasteTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Spindle_Model_DbTable_PasteTest::main") {
    Spindle_Model_DbTable_PasteTest::main();
}
