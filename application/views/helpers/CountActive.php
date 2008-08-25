<?php
class Zend_View_Helper_CountActive extends Zend_View_Helper_Abstract
{
    public function countActive()
    {
        $model = new Paste;
        return $model->fetchActiveCount();
    }
}
