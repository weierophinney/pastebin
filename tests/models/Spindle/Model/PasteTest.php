<?php
// Call Spindle_Model_PasteTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Spindle_Model_PasteTest::main");
}

require_once dirname(__FILE__) . '/../../../TestHelper.php';

require_once APPLICATION_PATH . '/modules/spindle/models/Paste.php';

/**
 * Test class for Paste.
 *
 * @todo  Test registering/manipulating plugins (need plugins, first)
 *
 * @group Spindle
 * @group Paste
 * @group Models
 */
class Spindle_Model_PasteTest extends PHPUnit_Framework_TestCase 
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Spindle_Model_PasteTest");
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
        include dirname(__FILE__) . '/../../../../scripts/loadTestDb.php';
        $this->model = new Spindle_Model_Paste();
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
        $this->assertFalse(empty($parent), 'Did not receive identifier');
        $data['parent'] = $parent;
        $child  = $this->model->add($data);
        $paste  = $this->model->get($child);
        $this->assertSame($paste['parent'], $parent, "Expected $parent; received " . var_export($paste['parent'], 1));
    }

    public function testParentPasteShouldNotBeReturnedIfExpired()
    {
        $data   = $this->getData();
        $parent = $this->model->add($data);
        $this->assertFalse(empty($parent), 'Did not receive identifier');

        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $db->update('paste', array('expires' => date('Y-m-d H:i:s', time() - 6789000)), $db->quoteInto('id = ?', $parent));

        $data['parent'] = $parent;
        $child  = $this->model->add($data);
        $paste  = $this->model->get($child);
        $this->assertTrue(empty($paste['parent']));
    }

    public function testChildPastesShouldBeReturnedAsAnArrayOfIdentifiers()
    {
        $data   = $this->getData();
        $parent = $this->model->add($data);
        $data['parent'] = $parent;
        $child1 = $this->model->add($data);
        $this->assertFalse(empty($child1), 'Failed to add first child paste');
        $child2 = $this->model->add($data);
        $this->assertFalse(empty($child2), 'Failed to add second child paste');
        $paste  = $this->model->get($parent);
        $this->assertTrue(array_key_exists('children', $paste));
        $this->assertTrue(is_array($paste['children']));
        $this->assertEquals(2, count($paste['children']), var_export($paste, 1));
        $this->assertEquals(array($child1, $child2), $paste['children']);
    }

    public function testChildPastesShouldNotIncludeExpiredPastes()
    {
        $data   = $this->getData();
        $parent = $this->model->add($data);
        $data['parent'] = $parent;

        $children = array();
        for ($i = 0; $i < 5; ++$i) {
            $child = $this->model->add($data);
            $this->assertFalse(empty($child), 'Failed to add child paste');
            $children[] = $child;
        }

        $paste  = $this->model->get($parent);
        $this->assertTrue(array_key_exists('children', $paste));
        $this->assertTrue(is_array($paste['children']));
        $this->assertEquals(5, count($paste['children']), var_export($paste, 1));

        $child = $paste['children'][2];
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $db->update('paste', array('expires' => date('Y-m-d H:i:s', time() - 6789000)), $db->quoteInto('id = ?', $child));

        $paste  = $this->model->get($parent);
        $this->assertTrue(array_key_exists('children', $paste));
        $this->assertTrue(is_array($paste['children']));
        $this->assertEquals(4, count($paste['children']), var_export($paste, 1));
    }

    public function testFetchActiveCountShouldReturnNumberOfActivePastes()
    {
        $data   = $this->getData();
        for ($i = 0; $i < 10; ++$i) {
            $this->model->add($data);
        }
        $count = $this->model->fetchActiveCount();
        $this->assertEquals(10, $count);
    }

    public function testFetchActiveShouldRetrieveAllActivePastesByDefault()
    {
        $data   = $this->getData();
        $ids    = array();
        for ($i = 0; $i < 10; ++$i) {
            $ids[] = $this->model->add($data);
        }
        $active = $this->model->fetchActive();
        $test   = array();
        foreach ($active as $paste) {
            $this->assertTrue(in_array($paste['id'], $ids));
        }
    }

    /**
     * @group fetch
     */
    public function testFetchingActivePastesShouldAllowFetchingAPageAtATime()
    {
        $data   = $this->getData();
        $ids    = array();
        for ($i = 0; $i < 100; ++$i) {
            $ids[] = $this->model->add($data);
        }
        $active = $this->model->fetchActive(array('start' => 10, 'count' => 10));
        $test   = array();
        foreach ($active as $paste) {
            $test[] = $paste['id'];
        }
        $this->assertEquals(10, count($test));
    }

    /**
     * @group fetch
     */
    public function testFetchingActivePastesShouldAllowSorting()
    {
        $data   = $this->getData();
        $users  = array();
        $ids    = array();
        for ($i = 0; $i < 100; ++$i) {
            $iData          = $data;
            $iData['user'] .= $i;
            $ids[]          = $this->model->add($iData);
            $users[]        = $iData['user'];
        }
        $active = $this->model->fetchActive(array('sort' => '-user'));
        $test   = array();
        foreach ($active as $paste) {
            $test[] = $paste['user'];
        }
        rsort($users);
        $this->assertEquals($users, $test);
    }

    /**
     * @group hooks
     */
    public function testPasteModelShouldDefinePreAndPostAddHooks()
    {
        $this->assertTrue($this->model->hasHook('preAdd'));
        $this->assertTrue($this->model->hasHook('postAdd'));
    }

    /**
     * @group hooks
     */
    public function testModelShouldAllowOverwritingHooks()
    {
        $hooks = array('preNothing', 'postNothing');
        $this->model->setHooks($hooks);
        $this->assertSame($hooks, $this->model->getHooks());
    }

    /**
     * @group hooks
     */
    public function testModelShouldAllowRemovingInvididualHooks()
    {
        $this->model->removeHook('postAdd');
        $this->assertFalse($this->model->hasHook('postAdd'));
    }
}

// Call Spindle_Model_PasteTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Spindle_Model_PasteTest::main") {
    Spindle_Model_PasteTest::main();
}
