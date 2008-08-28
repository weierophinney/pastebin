<?php
/**
 * CountActive view helper - retrieve count of active pastes
 * 
 * @uses      Zend_View_Helper_Abstract
 * @package   Paste
 * @license   New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version   $Id: $
 */
class Zend_View_Helper_CountActive extends Zend_View_Helper_Abstract
{
    /**
     * Return count of active pastes
     * 
     * @return int
     */
    public function countActive()
    {
        $model = new Paste;
        return $model->fetchActiveCount();
    }
}
