<?php
/**
 * CountActive view helper - retrieve count of active pastes
 * 
 * @uses       Zend_View_Helper_Abstract
 * @package    Spindle
 * @subpackage View
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_View_Helper_CountActive extends Zend_View_Helper_Abstract
{
    /**
     * Return count of active pastes
     * 
     * @return int
     */
    public function countActive()
    {
        require_once dirname(__FILE__) . '/../../models/Paste.php';
        $model = new Spindle_ModeL_Paste;
        return $model->fetchActiveCount();
    }
}
