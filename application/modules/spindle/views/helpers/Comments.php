<?php
class Spindle_View_Helper_Comments extends Zend_View_Helper_Abstract
{
    public function comments(Zend_Db_Table_Row_Abstract $bug)
    {
        $comments = $bug->findDependentRowset('Spindle_Model_DbTable_Comment');
        if (0 == count($comments)) {
            return '';
        }

        $html = '';
        foreach ($comments as $comment) {
            $user  = $comment->findParentRow('Spindle_Model_DbTable_User');
            $link  = $this->view->url(
                array(
                    'controller' => 'user',
                    'action'     => 'view',
                    'id'         => $user->id,
                ),
                'default',
                true
            );
            $html .= '<div class="comment">'
                  .  '<h4>Reported by <a href="' . $link . '">' . $this->view->escape($user->fullname) . '</a>'
                  .  ' on ' . date('Y-m-d', strtotime($comment->date_created)) . '</h4>'
                  .  '<p>' . $this->view->escape($comment->comment) . '</p>'
                  .  '</div>';
        }
        return $html;
    }
}
