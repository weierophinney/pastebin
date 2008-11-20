<?php
class Paste_Content
{
    protected $_plugin;
    protected $_view;

    public function __construct()
    {
    }

    protected function _getPlugin()
    {
        if (null === $this->_plugin) {
            $this->_plugin = new My_Plugin_Initialize(APPLICATION_ENV);
            $this->_plugin->initView(false);
        }
        return $this->_plugin;
    }

    protected function _getView()
    {
        if (null === $this->_view) {
            $this->_getPlugin();
            $this->_view = Zend_Registry::get('view');
            $this->_view->addScriptPath(APPLICATION_PATH . '/views/scripts');
        }
        return $this->_view;
    }

    /**
     * Get "about" screen
     * 
     * @return string
     */
    public function about()
    {
        return $this->_getView()->render('paste/content/about.phtml');
    }
}
