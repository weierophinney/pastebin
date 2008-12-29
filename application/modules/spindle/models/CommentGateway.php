<?php
/**
 * Comment gateway
 * 
 * @uses       Spindle_Model_Model
 * @package    Spindle
 * @subpackage Model
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney'
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Model_CommentGateway extends Spindle_Model_Gateway
{
    /**
     * @var string default validation chain (form)
     */
    protected $_defaultValidator = 'comment';

    /**
     * Primary table for operations
     * @var string
     */
    protected $_primaryTable = 'comment';

    /**
     * @var array ACL privilege map
     */
    protected $_privilegeMap = array(
        'guest'     => array('list'),
        'user'      => array('save'),
        'developer' => array('delete'),
    );

    /**
     * Columns protected from save operations
     * @var array
     */
    protected $_protectedColumns = array(
        'date_created',
        'date_deleted',
    );

    /**
     * @var string ACL resource identifier
     */
    protected $_resourceId = 'comment';

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
