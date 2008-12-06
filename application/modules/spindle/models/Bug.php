<?php
/** Spindle_Model_Model */
require_once dirname(__FILE__) . '/Model.php';

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
class Spindle_Model_Bug extends Spindle_Model_Model
{
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

    /**
     * Set sort order for returning results
     * 
     * @param  string $field 
     * @param  string $direction 
     * @return Bugapp_Bug
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
     * @return Bugapp_Bug
     */
    public function addSortOrder($field, $direction)
    {
        $this->_sortOrder[] = array($field . ' ' . $direction);
        return $this;
    }

    /**
     * Link one bug to another
     * 
     * @param  int $originalBug 
     * @param  int $linkedBug 
     * @param  int $linkType 
     * @return true
     */
    public function link($originalBug, $linkedBug, $linkType)
    {
        $table = $this->getResourceLoader()->getDbTable('BugRelation');
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
     * @return int
     */
    public function resolve($bugId, $resolutionId, $developerId)
    {
        $resolutions = $this->getResolutions();
        if (!in_array($resolutionId, array_keys($resolutions))) {
            throw new Exception('Invalid resolution type provided');
        }

        $table = $this->getResourceLoader()->getDbTable('bug');
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
     * @return int
     */
    public function close($bugId)
    {
        $table = $this->getResourceLoader()->getDbTable('bug');
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
     * @return int Number of rows updated
     */
    public function delete($bugId)
    {
        $table = $this->getResourceLoader()->getDbTable('bug');
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
        $table   = $this->getResourceLoader()->getDbTable('IssueType');
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
        $table   = $this->getResourceLoader()->getDbTable('ResolutionType');
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
        $table   = $this->getResourceLoader()->getDbTable('PriorityType');
        $adapter = $table->getAdapter();
        return $adapter->fetchPairs('select id, priority FROM priority_type');
    }

    /**
     * Fetch an individual bug by id
     * 
     * @param  int $id 
     * @return Zend_Db_Table_Row_Abstract|null
     */
    public function fetchBug($id)
    {
        $select = $this->_getSelect();
        $select->where('b.id = ?', $id)
               ->where('date_deleted IS NULL');
        return $this->getResourceLoader()->getDbTable('bug')->fetchRow($select);
    }

    /**
     * Fetch all open bugs
     * 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchOpenBugs($limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('date_closed IS NULL');
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch all closed bugs
     * 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchClosedBugs($limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('date_closed IS NOT NULL');
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch all resolved bugs
     * 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchResolvedBugs($limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('resolution_id > 2')
               ->where('date_closed IS NULL');
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch open bugs by reporter ID
     * 
     * @param  int $reporterId 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchOpenBugsByReporter($reporterId, $limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('date_closed IS NULL')
               ->where('reporter_id = ?', $reporterId);
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch resolved bugs by reporter
     * 
     * @param  int $reporterId 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchResolvedBugsByReporter($reporterId, $limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('resolution_id > 2')
               ->where('date_closed IS NULL')
               ->where('reporter_id = ?', $reporterId);
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch closed bugs by reporter ID
     * 
     * @param  int $reporterId 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchClosedBugsByReporter($reporterId, $limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('date_closed IS NOT NULL')
               ->where('reporter_id = ?', $reporterId);
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch open bugs by developer
     * 
     * @param  int $developerId 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchOpenBugsByDeveloper($developerId, $limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('date_closed IS NULL')
               ->where('developer_id = ?', $developerId);
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch resolved bugs by developer ID
     * 
     * @param  int $developerId 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchResolvedBugsByDeveloper($developerId, $limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('resolution_id > 2')
               ->where('date_closed IS NULL')
               ->where('developer_id = ?', $developerId);
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Fetch closed bugs by developer ID
     * 
     * @param  int $developerId 
     * @param  int|null $limit 
     * @param  int|null $offset 
     * @return Zend_Db_Table_Rowset|null
     */
    public function fetchClosedBugsByDeveloper($developerId, $limit = null, $offset = null)
    {
        $select = $this->_getSelect();
        $select->where('date_closed IS NOT NULL')
               ->where('developer_id = ?', $developerId);
        $this->_setLimit($select, $limit, $offset)
             ->_setSort($select);
        return $this->getResourceLoader()->getDbTable('bug')->fetchAll($select);
    }

    /**
     * Cleanup test bugs
     * 
     * @return void
     */
    public function cleanupTestBugs()
    {
        $this->getResourceLoader()->getDbTable('bug')->delete('description = "appBenchmarking"');
    }

    /**
     * Get select statement for bug table
     * 
     * @return Zend_Db_Table_Select
     */
    protected function _getSelect()
    {
        $bugTable = $this->getResourceLoader()->getDbTable('bug');
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
     * @return Bugapp_Bug
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
     * @return Bugapp_Bug
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
