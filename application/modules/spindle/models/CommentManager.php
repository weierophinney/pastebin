<?php
/**
 * Comment model
 * 
 * @uses       Spindle_Model_Model
 * @package    Spindle
 * @subpackage Model
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney'
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Model_CommentManager extends Spindle_Model_Model
{
    /**
     * @var string ACL resource to query
     */
    protected $_aclResource = 'comment';

    /**
     * @var string default validation chain (form)
     */
    protected $_defaultValidator = 'comment';

    /**
     * @var Spindle_Model_Form_Bug
     */
    protected $_form;

    /**
     * Primary table for operations
     * @var string
     */
    protected $_primaryTable = 'comment';

    /**
     * Columns protected from save operations
     * @var array
     */
    protected $_protectedColumns = array(
        'date_created',
        'date_deleted',
    );

    /**
     * Fetch all comments by path
     * 
     * @param  string $path
     * @return Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchCommentsByPath($path)
    {
        if (!$this->checkAcl('list')) {
            return false;
        }
        $select = $this->_getSelect()->where('path = ?', $path);
        $rowSet = $this->getDbTable('comment')->fetchAll($select);
        return new Spindle_Model_ResultSet($rowSet->toArray());
    }

    /**
     * Fetch comments by user ID
     * 
     * @param  int $userId 
     * @return Zend_Db_Table_Rowset_Abstract|
     */
    public function fetchCommentsByUser($userId)
    {
        if (!$this->checkAcl('list')) {
            return false;
        }
        $select = $this->_getSelect()->where('user_id = ?', $userId);
        $rowSet = $this->getDbTable('comment')->fetchAll($select);
        return new Spindle_Model_ResultSet($rowSet->toArray());
    }

    /**
     * Mark a comment as deleted
     * 
     * @param  int $id 
     * @return int
     */
    public function delete($id)
    {
        if (!$this->checkAcl('delete')) {
            return false;
        }
        $table = $this->getDbTable('comment');
        $where = $table->getAdapter()->quoteInto('id = ?', $id);
        return $table->update(
            array('date_deleted' => date('Y-m-d')),
            $where
        );
    }

    /**
     * Bug form/validation chain
     * 
     * @return Spindle_Model_Form_Comment
     */
    public function getCommentForm()
    {
        if (null === $this->_form) {
            $this->_form = new Spindle_Model_Form_Comment;
        }
        return $this->_form;
    }

    /**
     * Initialize SELECT statement
     * 
     * @return Zend_Db_Table_Select
     */
    protected function _getSelect()
    {
        $table  = $this->getDbTable('comment');
        $select = $table->select()
                        ->where('date_deleted IS NULL')
                        ->order('date_created ASC');
        return $select;
    }
}
