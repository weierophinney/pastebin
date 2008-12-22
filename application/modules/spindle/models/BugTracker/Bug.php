<?php
class Spindle_Model_BugTracker_Bug extends Spindle_Model_Result
{
    protected $_allowed = array(
        'id',
        'reporter_id',
        'developer_id',
        'priority_id',
        'type_id',
        'resolution_id',
        'summary',
        'description',
        'date_created',
        'date_resolved',
        'date_closed',
        'date_deleted',
    );
}
