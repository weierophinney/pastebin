<?php
// Call models_PasteTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "models_PasteTest::main");
}

require_once dirname(__FILE__) . '/../TestHelper.php';

/** Paste */
require_once 'Paste.php';

/**
 * Test class for Paste.
 */
class models_PasteTest extends PHPUnit_Framework_TestCase 
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("models_PasteTest");
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
        $this->model = new Paste();
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

    public function testShouldAllowAddingPastes()
    {
        $this->model->add($this->getData());
    }

    public function testAddingPastesShouldReturnPasteIdentifier()
    {
        $id = $this->model->add($this->getData());
        $this->assertRegexp('/^[a-z0-9]{13}$/', $id);
    }

    public function testShouldAllowRetrievingPastesByIdentifier()
    {
        $data  = $this->getData();

        foreach (range(1, 3) as $index) {
            $insertData          = $data;
            $insertData['user'] .= $index;
            $id = $this->model->add($insertData);
        }
        $paste = $this->model->get($id);
        $this->assertTrue($paste !== false);
        $this->assertEquals($insertData['user'], $paste['user']);
    }

    public function testShouldReturnFalseForExpiredPastes()
    {
        $data  = $this->getData();
        $data['expires'] = -3600;
        $id    = $this->model->add($data);
        $paste = $this->model->get($id);
        $this->assertFalse($paste);
    }

    public function testRetrievingPastesShouldReturnAnArray()
    {
        $data  = $this->getData();
        $id    = $this->model->add($data);
        $paste = $this->model->get($id);
        $this->assertTrue(is_array($paste));
        $this->assertEquals($data['code'], $paste['code']);
        $this->assertEquals($data['summary'], $paste['summary']);
        $this->assertEquals($data['user'], $paste['user']);
        $this->assertEquals($data['type'], $paste['type']);
    }

    public function testParentPasteShouldBeReturnedAsAnIdentifier()
    {
        $data   = $this->getData();
        $parent = $this->model->add($data);
        $data['parent'] = $parent;
        $child  = $this->model->add($data);
        $paste  = $this->model->get($child);
        $this->assertSame($paste['parent'], $parent);
    }

    public function testChildPastesShouldBeReturnedAsAnArrayOfIdentifiers()
    {
        $data   = $this->getData();
        $parent = $this->model->add($data);
        $data['parent'] = $parent;
        $child1 = $this->model->add($data);
        $child2 = $this->model->add($data);
        $paste  = $this->model->get($parent);
        $this->assertTrue(array_key_exists('children', $paste));
        $this->assertTrue(is_array($paste['children']));
        $this->assertEquals(2, count($paste['children']));
        $this->assertEquals(array($child1, $child2), $paste['children']);
    }
}

// Call models_PasteTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "models_PasteTest::main") {
    models_PasteTest::main();
}
