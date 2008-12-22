<?php
class Spindle_Model_CommentManager_Comment extends Spindle_Model_Result
{
    protected $_allowed = array(
        'id',
        'user_id',
        'path',
        'comment',
        'date_created',
        'date_deleted',
    );
}
