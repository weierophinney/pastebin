<?php
// Call Spindle_Model_CommentTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Spindle_Model_CommentTest::main");
}

require_once dirname(__FILE__) . '/../../../TestHelper.php';

/** Spindle_Model_Comment */
require_once APPLICATION_PATH . '/modules/spindle/models/Comment.php';

/**
 * Test class for Spindle_Model_Comment.
 *
 * @group Spindle
 * @group Bug
 * @group Models
 */
class Spindle_Model_CommentTest extends PHPUnit_Framework_TestCase 
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Spindle_Model_CommentTest");
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
        $this->model = new Spindle_Model_Comment();
        $this->truncateTable();
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

    public function truncateTable()
    {
        $this->model->getResourceLoader()->getDbTable('comment')->getAdapter()->getConnection()->exec('DELETE FROM comment');
    }

    public function populateTable()
    {
        for ($i = 1; $i <= 10; ++$i) {
            $bugId = ($i % 2) + 1;
            $this->model->save(array(
                'bug_id'  => $bugId,
                'user_id' => $bugId,
                'comment' => 'This is a test comment',
            ));
        }
    }

    public function testShouldBeAbleToPullCommentsByBug()
    {
        $this->populateTable();
        $comments = $this->model->fetchCommentsByBug(1);
        $this->assertTrue($comments instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertEquals(5, count($comments));

        $comments = $this->model->fetchCommentsByBug(2);
        $this->assertTrue($comments instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertEquals(5, count($comments));
    }

    public function testShouldBeAbleToPullCommentsByUser()
    {
        $this->populateTable();
        $comments = $this->model->fetchCommentsByUser(1);
        $this->assertTrue($comments instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertEquals(5, count($comments));

        $comments = $this->model->fetchCommentsByUser(2);
        $this->assertTrue($comments instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertEquals(5, count($comments));
    }

    public function testShouldAllowDeletingComments()
    {
        $this->populateTable();
        $comments = $this->model->fetchCommentsByUser(1);
        foreach ($comments as $comment) {
            $this->model->delete($comment->id);
        }
        $comments = $this->model->fetchCommentsByUser(1);
        $this->assertEquals(0, count($comments));
    }
}

// Call Spindle_Model_CommentTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Spindle_Model_CommentTest::main") {
    Spindle_Model_CommentTest::main();
}
