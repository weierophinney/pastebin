<?php
/**
 * Plugin to initialize application state
 * 
 * @uses       Zend_Controller_Plugin_Abstract
 * @package    My
 * @subpackage Plugin
 * @version    $Id: $
 */
class My_Plugin_Initialize extends Zend_Controller_Plugin_Abstract
{
    public function __construct($basePath, $env = 'production')
    {
        $this->env      = $env;

        $this->basePath = $basePath;
        $this->appPath  = $this->basePath . '/application';
        $this->libPath  = $this->basePath . '/library';
        $this->pubPath  = $this->basePath . '/public';
        $this->front    = Zend_Controller_Front::getInstance();
    }

    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->initConfig()
             ->initControllers()
             ->initCache()
             ->initDb()
             ->initView();
    }

    public function initConfig()
    {
        $config = new Zend_Config_Ini($this->appPath . '/configs/paste.ini', $this->env, true);

        $config->paths->basePath = $this->basePath;
        $config->paths->appPath  = $this->appPath;
        $config->paths->libPath  = $this->libPath;
        $config->paths->pubPath  = $this->pubPath;

        $config->db->cxn->params->dbname = $config->paths->appPath . '/data/' . $config->db->cxn->params->dbname;
        $config->db->cache->backendOptions->cache_db_complete_path = $config->paths->appPath . '/data/' . $config->db->cache->backendOptions->cache_db_complete_path;

        $config->cache->backendOptions->cache_db_complete_path = $config->paths->appPath . '/data/' . $config->cache->backendOptions->cache_db_complete_path;

        $this->config = $config;
        Zend_Registry::set('config', $config);
        return $this;
    }

    public function initControllers()
    {
        $this->front->setControllerDirectory($this->appPath . '/controllers', 'default');
        return $this;
    }

    public function initCache()
    {
        $config = $this->config->cache;
        $this->cache = $this->_getCache($config);
        Zend_Registry::set('cache', $this->cache);
        return $this;
    }

    public function initDb()
    {
        $config   = $this->config->db;
        $cache    = $this->_getCache($config->cache);
        $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
        $db       = Zend_Db::factory($config->cxn);

        $db->setProfiler($profiler);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);

        return $this;
    }

    public function initView()
    {
        $layout = Zend_Layout::startMvc(array(
            'layoutPath' => $this->appPath . '/views/layouts'
        ));

        $view = $layout->getView();
        $view->addHelperPath('My/View/Helper/', 'My_View_Helper');

        $view->headLink()->appendStylesheet('/style/paste.css');

        Zend_Dojo::enableView($view);
        $view->doctype('XHTML1_TRANSITIONAL');
        $view->headTitle('Pastebin');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        $view->dojo()->setDjConfigOption('usePlainJson', true)
                     ->setDjConfigOption('isDebug', true)
                     ->addStylesheetModule('dijit.themes.tundra')
                     ->addStylesheet('/js/dojox/grid/_grid/tundraGrid.css')
                     ->addStylesheet('/js/dojo/resources/dojo.css')
                     ->setLocalPath('/js/dojo/dojo.js')
                     // ->addLayer('/js/paste/main.js')
                     ->addLayer('/js/paste/paste.js')
                     ->addJavascript('paste.main.init();')
                     ->disable();

        return $this;
    }

    protected function _getCache(Zend_Config $config)
    {
        $cache = Zend_Cache::factory(
            $config->frontendName,
            $config->backendName,
            $config->frontendOptions->toArray(),
            $config->backendOptions->toArray()
        );
        return $cache;
    }
}
