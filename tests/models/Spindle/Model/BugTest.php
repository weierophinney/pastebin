<?php
// Call Spindle_Model_BugTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Spindle_Model_BugTest::main");
}

require_once dirname(__FILE__) . '/../../../TestHelper.php';

/** Spindle_Model_Bug */
require_once APPLICATION_PATH . '/modules/spindle/models/Bug.php';

/**
 * Test class for Spindle_Model_Bug.
 *
 * @group Spindle
 * @group Bug
 * @group Models
 */
class Spindle_Model_BugTest extends PHPUnit_Framework_TestCase 
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Spindle_Model_BugTest");
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
        include dirname(__FILE__) . '/../../../../scripts/loadTestBugData.php';
        $this->model = new Spindle_Model_Bug();
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

    public function testShouldContainResourceLoader()
    {
        $loader = $this->model->getResourceLoader();
        $this->assertTrue($loader instanceof My_Controller_Helper_ResourceLoader);
    }

    public function testGetTypesShouldReturnHashOfIdsAndTypes()
    {
        $types = $this->model->getTypes();
        $this->assertTrue(is_array($types));
        $this->assertTrue(0 < count($types));
        foreach ($types as $key => $type) {
            $this->assertTrue(is_numeric($key));
            $this->assertTrue(is_string($type));
        }
    }

    public function testGetResolutionsShouldReturnHashOfIdsAndResolutions()
    {
        $resolutions = $this->model->getResolutions();
        $this->assertTrue(is_array($resolutions));
        $this->assertTrue(0 < count($resolutions));
        foreach ($resolutions as $key => $resolution) {
            $this->assertTrue(is_numeric($key));
            $this->assertTrue(is_string($resolution));
        }
    }

    public function testGetPrioritiesShouldReturnHashOfIdsAndPriorities()
    {
        $priorities = $this->model->getPriorities();
        $this->assertTrue(is_array($priorities));
        $this->assertTrue(0 < count($priorities));
        foreach ($priorities as $key => $priority) {
            $this->assertTrue(is_numeric($key));
            $this->assertTrue(is_string($priority));
        }
    }

    public function insertBug()
    {
        $data = array(
            'reporter_id' => 1,
            'priority_id' => 3,
            'type_id'     => 1,
            'summary'     => 'Test bug',
            'description' => 'This is simply a test bug',
        );
        return $this->model->save($data);
    }

    public function testShouldAllowAddingBugs()
    {
        $id = $this->insertBug();
        $this->assertTrue(is_numeric($id), $id);

        $bug = $this->model->fetchBug($id);
        $this->assertTrue($bug instanceof Zend_Db_Table_Row_Abstract);
        $this->assertEquals(1, $bug->reporter_id);
        $this->assertEquals(3, $bug->priority_id);
        $this->assertEquals(1, $bug->type_id);
        $this->assertEquals('Test bug', $bug->summary);
        $this->assertContains('test bug', $bug->description);
    }

    public function testFetchOpenBugsShouldReturnRowsetWithOpenBugs()
    {
        for ($i = 0; $i < 5; ++$i) {
            $this->insertBug();
        }
        $bugs = $this->model->fetchOpenBugs();
        $this->assertTrue($bugs instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertTrue(5 <= count($bugs));
    }

    public function testShouldAllowResolvingBugs()
    {
        $ids = array();
        for ($i = 0; $i < 5; ++$i) {
            $ids[] = $this->insertBug();
        }
        foreach ($ids as $id) {
            $this->model->resolve($id, 5, 1);
        }
    }

    public function testFetchResolvedBugsShouldFetchOnlyResolvedBugs()
    {
        $openBugs = $this->model->fetchOpenBugs();
        $this->testShouldAllowResolvingBugs();
        $resolvedBugs = $this->model->fetchResolvedBugs();
        $this->assertTrue(count($openBugs) >= count($resolvedBugs));
        $this->assertTrue(5 <= count($resolvedBugs));
    }

    public function testShouldAllowClosingBugs()
    {
        $ids = array();
        for ($i = 0; $i < 5; ++$i) {
            $ids[] = $this->insertBug();
        }
        foreach ($ids as $id) {
            $this->model->close($id);
        }
        $closedBugs = $this->model->fetchClosedBugs();
        $this->assertTrue(5 <= count($closedBugs));
        $openBugs = $this->model->fetchOpenBugs();
        foreach ($openBugs as $bug) {
            $this->assertTrue(!in_array($bug->id, $ids));
        }
    }

    public function testDeletingBugsShouldMerelyMarkAsDeleted()
    {
        $ids = array();
        for ($i = 0; $i < 5; ++$i) {
            $ids[] = $this->insertBug();
        }
        foreach ($ids as $id) {
            $this->model->delete($id);
        }
        $table = $this->model->getResourceLoader()->getDbTable('bug');
        foreach ($ids as $id) {
            $select = $table->select();
            $select->where('id = ?', $id);
            $row = $table->fetchRow($select);
            $this->assertFalse(empty($row->date_deleted));
        }
    }
}

// Call Spindle_Model_BugTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Spindle_Model_BugTest::main") {
    Spindle_Model_BugTest::main();
}
