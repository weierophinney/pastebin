<?php
class Spindle_View_Helper_Comments extends Zend_View_Helper_Abstract
{
    protected $_model = array();

    public function comments($path)
    {
        $commentModel = $this->getModel('Comment');
        $comments     = $commentModel->fetchCommentsByPath($path);
        if (0 == count($comments)) {
            return '<p>No comments</p>'
                 . $this->renderForm($path);
        }

        $html = '';
        foreach ($comments as $comment) {
            $user  = $this->getModel('User')->fetchUser($comment->user_id);
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
                  .  '<h4>Poseted by <a href="' . $link . '">' . $this->view->escape($user->fullname) . '</a>'
                  .  ' on ' . date('Y-m-d', strtotime($comment->date_created)) . '</h4>'
                  .  '<p>' . $this->view->escape($comment->comment) . '</p>'
                  .  '</div>';
        }

        $html .= $this->renderForm($path);

        return $html;
    }

    public function renderForm($path)
    {
        $html = '';
        $commentModel = $this->getModel('Comment');
        if ($commentModel->checkAcl('save')) {
            $form = $commentModel->getCommentForm();
            $form->setMethod('post')
                 ->setAction($this->view->url(
                       array(
                           'module'     => 'spindle',
                           'controller' => 'bug',
                           'action'     => 'comment',
                       ),
                       'default',
                       true
                   ));
            $form->path->setValue($path);
            $form->user_id->setValue($commentModel->getIdentity()->id);
            $html .= '<h3>Submit a comment:</h3>'
                  .  $form;
        }
        return $html;
    }

    public function getModel($name)
    {
        if (!isset($this->_model[$name])) {
            $class = 'Spindle_Model_' . $name;
            $this->_model[$name] = new $class;
        }
        return $this->_model[$name];
    }

    public function setModel($name, $model)
    {
        $this->_model[$name] = $model;
        return $this;
    }
}
