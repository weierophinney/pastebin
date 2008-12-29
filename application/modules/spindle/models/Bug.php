<?php
class Spindle_Model_Bug extends Spindle_Model_Value 
{
    protected $_allowed = array(
        'id',
        'reporter_id',
        'developer_id',
        'priority',
        'priority_id',
        'issue_type',
        'type_id',
        'resolution',
        'resolution_id',
        'summary',
        'description',
        'date_created',
        'date_resolved',
        'date_closed',
        'date_deleted',
    );

    protected $_form;

    protected $_gateway;

    public function __construct($data, $options = null)
    {
        $this->setOptions($options);
        if (null === $this->getGateway()) {
            throw new Spindle_Model_Exception('Bug object requires gateway object');
        }

        if (is_string($data)) {
            $this->fetch($data);
        } else {
            $this->populate($data);
        }
    }

    public function __set($name, $value)
    {
        if (!in_array($name, $this->_allowed)) {
            return;
        }

        $inputFilter = $this->getForm();
        if ($element = $inputFilter->getElement($name)) {
            if (!$element->isValid($value)) {
                return;
            }
            $value = $element->getValue();
        }

        $this->_data[$name] = $value;
    }

    public function setGateway(Spindle_Model_BugTracker $gateway)
    {
        $this->_gateway = $gateway;
        return $gateway;
    }

    public function getGateway()
    {
        return $this->_gateway;
    }

    public function getForm()
    {
        if (null === $this->_form) {
            $this->_form = new Spindle_Model_Form_Bug();
        }
        return $this->_form;
    }

    public function populate($data)
    {
        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        } elseif (is_object($data)) {
            $data = (array) $data;
        }
        if (!is_array($data)) {
            throw new Spindle_Model_Exception('Invalid data provided to populate comment');
        }

        $inputFilter = $this->getForm();
        if (!$inputFilter->isValid($data)) {
            return false;
        }

        $this->_data = array_merge($this->_data, $inputFilter->getValues());
        return true;
    }

    public function fetch($criteria = null)
    {
        $table  = $this->getGateway()->getDbTable('bug');
        $select = $table->select();
        $select->setIntegrityCheck(false)
               ->from(array('b' => 'bug'))
               ->joinLeft(array('i' => 'issue_type'), 'i.id = b.type_id', array('issue_type' => 'type'))
               ->joinLeft(array('r' => 'resolution_type'), 'r.id = b.resolution_id', array('resolution'))
               ->joinLeft(array('p' => 'priority_type'), 'p.id = b.priority_id', array('priority'))
               ->where('date_deleted IS NULL'); // never fetch deleted bugs
        if ($criteria) {
            $select->where('b.id = ?', $criteria);
        } else {
            if (isset($this->id)) {
                $select->where('b.id = ?', $this->id);
                $criteria = $this->id;
            }
            if (null === $criteria) {
                throw new Spindle_Model_Exception('No criteria provided');
            }
        }

        $row = $table->fetchRow($select);
        if ($row) {
            $this->populate($row);
            return true;
        }

        return false;
    }

    public function save($data = null)
    {
        $gateway = $this->getGateway();
        if (!$gateway->checkAcl('save')) {
            $this->getForm()->addErrorMessage('You do not have credentials to comment');
            return false;
        }

        if (null !== $data) {
            $data = (array) $data;
            $inputFilter = $this->getForm();
            if (!$inputFilter->isValid($data)) {
                return false;
            }
            $this->populate($inputFilter->getValues());
        }

        $table  = $gateway->getDbTable('bug');
        if (!$this->id) {
            $id = $table->insert($this->_data);
            $this->id = $id;
        } else {
            $data = $this->_data;
            unset($data['id']);

            $id    = $this->id;
            $where = $table->getAdapter()->quoteInto('id = ?', $id);

            $table->update($data, $where);
        }

        return $id;
    }

    public function delete()
    {
        $gateway = $this->getGateway();
        if (!$gateway->checkAcl('delete')) {
            return false;
        }
        $table = $gateway->getDbTable('bug');
        $where = $table->getAdapter()->quoteInto('id = ?', $this->id);
        if ($table->update(array('date_deleted' => date('Y-m-d')), $where)) {
            $this->_data = array();
            return true;
        }
        return false;
    }

    public function close()
    {
        $gateway = $this->getGateway();
        if (!$gateway->checkAcl('close')) {
            return false;
        }
        $table = $gateway->getDbTable('bug');
        $where = $table->getAdapter()->quoteInto('id = ?', $this->id);
        $date  = date('Y-m-d');
        $data  = array(
            'date_closed' => $date,
        );
        if (!$table->update($data, $where)) {
            return false;
        }

        $this->date_closed = $date;
        return true;
    }

    public function resolve($resolutionId, $developerId)
    {
        $gateway = $this->getGateway();
        if (!$gateway->checkAcl('resolve')) {
            return false;
        }

        $resolutions = $gateway->getResolutions();
        if (!in_array($resolutionId, array_keys($resolutions))) {
            throw new Exception('Invalid resolution type provided');
        }

        $table = $gateway->getDbTable('bug');
        $where = $table->getAdapter()->quoteInto('id = ?', $bugId);
        $date  = date('Y-m-d');
        $data  = array(
            'date_resolved' => $date,
            'developer_id'  => $developerId,
            'resolution_id' => $resolutionId,
        );
        if (!$table->update($data, $where)) {
            return false;
        }

        $this->date_resolved = $date;
        $this->developer_id  = $developerId;
        $this->resolution_id = $resolutionId;
        return true;
    }

    public function link($linkedBug, $linkType)
    {
        $gateway = $this->getGateway();
        if (!$gateway->checkAcl('link')) {
            return false;
        }
        $table  = $gateway->getDbTable('BugRelation');
        $select = $table->select();
        $select->where('bug_id = ?', $this->id)
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
               ->where('related_id = ?', $this->id);
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
            'bug_id'        => $this->id,
            'related_id'    => $linkedBug,
            'relation_type' => $linkType,
        );
        $table->insert($data);
        return true;
    }

}
