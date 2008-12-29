<?php
class Spindle_Model_BugTracker_Bug extends Spindle_Model_Value
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
}
