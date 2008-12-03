<?php
/**
 * Cache view helper - cache content for later retrieval, or pull from cache
 * 
 * @uses       Zend_View_Helper_Abstract
 * @package    Spindle
 * @subpackage View
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class Spindle_View_Helper_Cache extends Zend_View_Helper_Abstract
{
    protected $_basePath;

    protected $_cache = true;

    public function __construct()
    {
        if (Zend_Registry::isRegistered('config')) {
            $config = Zend_Registry::get('config');
            $this->_cache = (bool) $config->cache->frontendOptions->caching;
        }
    }

    /**
     * Caching operations for view
     * 
     */
    public function cache()
    {
        return $this;
    }

    public function setBasePath($path)
    {
        $this->_basePath = rtrim($path, '/') . '/';
        return $this;
    }

    public function getBasePath()
    {
        return $this->_basePath;
    }

    public function load($script)
    {
        if (!$this->_cache) {
            return false;
        }

        if (null !== ($basePath = $this->getBasePath())) {
            $script = $basePath . $script;
        }
        if ($content = @file_get_contents($script)) {
            return $content;
        }
        return false;
    }

    public function save($script, $content)
    {
        if (!$this->_cache) {
            return true;
        }

        if (null !== ($basePath = $this->getBasePath())) {
            $script = $basePath . $script;
        }

        return (file_put_contents($script, $content)) ? true : false;
    }
}
