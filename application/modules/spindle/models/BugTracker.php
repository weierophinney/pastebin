<?php
/**
 * Bug application model
 * 
 * @uses       Spindle_Model_Model
 * @package    Spindle
 * @subpackage Model
 * @copyright  Copyright (C) 2008 - Present, Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_Model_BugTracker extends Spindle_Model_Model
{
    /**
     * @var string ACL resource to query
     */
    protected $_aclResource = 'bug';

    /**
     * @var string default validation chain (form)
     */
    protected $_defaultValidator = 'bug';

    /**
     * @var Spindle_Model_Form_Bug
     */
    protected $_form;

    /**
     * Primary table for operations
     * @var string
     */
    protected $_primaryTable = 'bug';

    /**
     * Columns that may not be specified in save operations
     * @var array
     */
    protected $_protectedColumns = array(
        'date_created',
        'date_resolved',
        'date_deleted',
    );

    /**
     * @var array Sort orders
     */
    protected $_sortOrder = array();

    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->getPluginProvider()->subscribe('save::preSave', $this, 'setReporter');
    }

    /**
     * Set sort order for returning results
     * 
     * @param  string $field 
     * @param  string $direction 
     * @return Spindle_Model_Bug
     */
    public function setSortOrder($field, $direction)
    {
        $this->_sortOrder = array(array($field . ' ' . $direction));
        return $this;
    }

    /**
     * Add a sort order for returning results
     * 
     * @param  string $field 
     * @param  string $direction 
     * @return Spindle_Model_Bug
     */
    public function addSortOrder($field, $direction)
    {
        $this->_sortOrder[] = array($field . ' ' . $direction);
        return $this;
    }

    /**
     * Set reporter_id for a row
     * 
     * @param  object $row 
     * @return void
     */
    public function setReporter($row)
    {
        if (is_object($row) && empty($row->id) && isset($row->reporter_id)) {
            $identity = $this->getIdentity();
            if ($identity && !empty($identity->id)) {
                $row->reporter_id = $identity->id;
            }
        }
    }

    /**
     * Link one bug to another
     * 
     * @param  int $originalBug 
     * @param  int $linkedBug 
     * @param  int $linkType 
     * @return bool False if not allowed, true otherwise
     */
    public function link($originalBug, $linkedBug, $linkType)
    {
        if (!$this->checkAcl('link')) {
            return false;
        }
        $table  = $this->getDbTable('BugRelation');
        $select = $table->select();
        $select->where('bug_id = ?', $originalBug)
               ->where('related_id = ?', $linkedBug);
        $links = $table->fetchAll($select);
        if (count($links) > 0) {
            $link = $links->current();
            if ($link->relation_type != $linkType) {
                $link->relation_type = $linkType;
                $link->save();
            }
            return true;
        }

        $select = $table->select();
        $select->where('bug_id = ?', $linkedBug)
               ->where('related_id = ?', $originalBug);
        $links = $table->fetchAll($select);
        if (count($links) > 0) {
            $link = $links->current();
            if ($link->relation_type != $linkType) {
                $link->relation_type = $linkType;
                $link->save();
            }
            return true;
        }

        $data = array(
            'bug_id'        => $originalBug,
            'related_id'    => $linkedBug,
            'relation_type' => $linkType,
        );
        $table->insert($data);
        return true;
    }

    /**
     * Resolve a bug
     * 
     * @param  int $bugId 
     * @param  int $resolutionId 
     * @param  int $developerId 
     * @return false|int False if no privs, ID of row otherwise
     */
    public function resolve($bugId, $resolutionId, $developerId)
    {
        if (!$this->checkAcl('resolve')) {
            return false;
        }
        $resolutions = $this->getResolutions();
        if (!in_array($resolutionId, array_keys($resolutions))) {
            throw new Exception('Invalid resolution type provided');
        }

        $table = $this->getDbTable('bug');
        $where = $table->getAdapter()->quoteInto('id = ?', $bugId);
        $data  = array(
            'date_resolved' => date('Y-m-d'),
            'developer_id'  => $developerId,
            'resolution_id' => $resolutionId,
        );
        return $table->update($data, $where);
    }

    /**
     * Close a bug
     * 
     * @param  int $bugId 
     * @return int|false ID of row on success, false otherwise
     */
    public function close($bugId)
    {
        if (!$this->checkAcl('close')) {
            return false;
        }
        $table = $this->getDbTable('bug');
        $where = $table->getAdapter()->quoteInto('id = ?', $bugId);
        $data  = array(
            'date_closed' => date('Y-m-d'),
        );
        return $table->update($data, $where);
    }

    /**
     * Delete a bug
     * 
     * @param  int $bugId 
     * @return int|false Number of rows updated; false if no privileges
     */
    public function delete($bugId)
    {
        if (!$this->checkAcl('delete')) {
            return false;
        }
        $table = $this->getDbTable('bug');
        $where = $table->getAdapter()->quoteInto('id = ?', $bugId);
        return $table->update(array('date_deleted' => date('Y-m-d')), $where);
    }

    /**
     * Get bug types as assoc array
     * 
     * @return array
     */
    public function getTypes()
    {
        $table   = $this->getDbTable('IssueType');
        $adapter = $table->getAdapter();
        return $adapter->fetchPairs('select id, type FROM issue_type');
    }

    /**
     * Get bug resolutions as assoc array
     * 
     * @return array
     */
    public function getResolutions()
    {
        $table   = $this->getDbTable('ResolutionType');
        $adapter = $table->getAdapter();
        return $adapter->fetchPairs('select id, resolution FROM resolution_type');
    }

    /**
     * Get bug priorities as assoc array
     * 
     * @return array
     */
    public function getPriorities()
    {
        $table   = $this->getDbTable('PriorityType');
        $adapter = $table->getAdapter();
        return $adapter->fetchPairs('select id, priority FROM priority_type');
    }

    /**
     * Fetch an individual bug by id
     * 
     * @param  int $id 
     * @return Zend_Paginator|Spindle_Model_BugTracker_Bug|null|false False on lack of privileges
     */
    public function fetchBug($id)
    {
        if (!$this->checkAcl('view')) {
            return false;
        }
        $select = $this->_getSelect();
        $select->where('b.id = ?', $id)
               ->where('date_deleted IS NULL');
        $row = $this->getDbTable('bug')->fetchRow($select);
        return (null !== $row) ? new Spindle_Model_BugTracker_Bug($row->toArray()) : null;
    }

    public function fetchAllBugs($offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(), $limit, $offset);
    }

    /**
     * Fetch all open bugs
     * 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchOpenBugs($offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'date_closed IS NULL',
        ), $limit, $offset);
    }

    /**
     * Fetch all closed bugs
     * 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchClosedBugs($offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'date_closed IS NOT NULL',
        ), $limit, $offset);
    }

    /**
     * Fetch all resolved bugs
     * 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchResolvedBugs($offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'resolution_id > 2',
            'date_closed IS NULL',
        ), $limit, $offset);
    }

    /**
     * Fetch open bugs by reporter ID
     * 
     * @param  int $reporterId 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchOpenBugsByReporter($reporterId, $offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'date_closed IS NULL',
            array('reporter_id = ?', $reporterId),
        ), $limit, $offset);
    }

    /**
     * Fetch resolved bugs by reporter
     * 
     * @param  int $reporterId 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchResolvedBugsByReporter($reporterId, $offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'resolution_id > 2',
            'date_closed IS NULL',
            array('reporter_id = ?', $reporterId),
        ), $limit, $offset);
    }

    /**
     * Fetch closed bugs by reporter ID
     * 
     * @param  int $reporterId 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchClosedBugsByReporter($reporterId, $offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'date_closed IS NOT NULL',
            array('reporter_id = ?', $reporterId),
        ), $limit, $offset);
    }

    /**
     * Fetch open bugs by developer
     * 
     * @param  int $developerId 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchOpenBugsByDeveloper($developerId, $limit = null, $offset = null)
    {
        return $this->_fetchBugs(array(
            'date_closed IS NULL',
            array('developer_id = ?', $developerId),
        ), $limit, $offset);
    }

    /**
     * Fetch resolved bugs by developer ID
     * 
     * @param  int $developerId 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchResolvedBugsByDeveloper($developerId, $offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'resolution_id > 2',
            'date_closed IS NULL',
            array('developer_id = ?', $developerId),
        ), $limit, $offset);
    }

    /**
     * Fetch closed bugs by developer ID
     * 
     * @param  int $developerId 
     * @param  int|null $offset 
     * @param  int|null $limit 
     * @return Zend_Paginator|Spindle_Model_ResultSet|false False if no privileges
     */
    public function fetchClosedBugsByDeveloper($developerId, $offset = null, $limit = null)
    {
        return $this->_fetchBugs(array(
            'date_closed IS NOT NULL',
            array('developer_id = ?', $developerId),
        ), $limit, $offset);
    }

    /**
     * Bug form/validation chain
     * 
     * @return Spindle_Model_Form_Bug
     */
    public function getBugForm()
    {
        if (null === $this->_form) {
            $this->_form = new Spindle_Model_Form_Bug;
        }
        return $this->_form;
    }

    /**
     * Cleanup test bugs
     * 
     * @return void
     */
    public function cleanupTestBugs()
    {
        $this->getDbTable('bug')->delete('description = "appBenchmarking"');
    }

    /**
     * Fetch bugs by criteria, limit, and offset
     * 
     * @param  array $criteria 
     * @param  string $limit 
     * @param  int $offset 
     * @return false|Spindle_Model_BugTracker_Bugs|Zend_Paginator
     */
    protected function _fetchBugs(array $criteria, $limit, $offset)
    {
        if (!$this->checkAcl('list')) {
            return false;
        }

        $select = $this->_getSelect();

        foreach ($criteria as $criterion) {
            if (is_array($criterion)) {
                $statement = array_shift($criterion);
                $value     = array_shift($criterion);
                $select->where($statement, $value);
            } else {
                $select->where($criterion);
            }
        }

        if ($this->usePaginator()) {
            $page      = (null === $offset) ? 1 : (int) $offset;
            $paginator = new Zend_Paginator(
                new Zend_Paginator_Adapter_DbSelect($select)
            );
            $paginator->setItemCountPerPage(15)
                      ->setCurrentPageNumber($page);
            return $paginator;
        } else {
            $this->_setLimit($select, $limit, $offset)
                 ->_setSort($select);
        }
        $rowSet = $this->getDbTable('bug')->fetchAll($select);
        return new Spindle_Model_BugTracker_Bugs($rowSet->toArray());
    }

    /**
     * Get select statement for bug table
     * 
     * @return Zend_Db_Table_Select
     */
    protected function _getSelect()
    {
        $bugTable = $this->getDbTable('bug');
        $select   = $bugTable->select()->setIntegrityCheck(false);
        $select->from(array('b' => 'bug'))
               ->joinLeft(array('i' => 'issue_type'), 'i.id = b.type_id', array('issue_type' => 'type'))
               ->joinLeft(array('r' => 'resolution_type'), 'r.id = b.resolution_id', array('resolution'))
               ->joinLeft(array('p' => 'priority_type'), 'p.id = b.priority_id', array('priority'))
               ->where('date_deleted IS NULL'); // never fetch deleted bugs
        return $select;
    }

    /**
     * Set limit and offset on select object
     * 
     * @param  Zend_Db_Table_Select $select 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Spindle_Model_Bug
     */
    protected function _setLimit(Zend_Db_Table_Select $select, $limit, $offset)
    {
        if (null !== $limit) {
            if (null === $offset) {
                $offset = 0;
            }

            $select->limit((int) $limit, (int) $offset);
        }
        return $this;
    }

    /**
     * Set sort order on select object
     * 
     * @param  Zend_Db_Table_Select $select 
     * @return Spindle_Model_Bug
     */
    protected function _setSort(Zend_Db_Table_Select $select)
    {
        if (!empty($this->_sortOrder)) {
            foreach ($this->_sortOrder as $sortSpec) {
                $select->order($sortSpec);
            }
        }
        return $this;
    }
}
