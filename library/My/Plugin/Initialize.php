<?php
/** Zend_Controller_Plugin_Abstract */
require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * Plugin to initialize application state
 * 
 * @uses       Zend_Controller_Plugin_Abstract
 * @category   My
 * @package    My_Plugin
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_Plugin_Initialize extends Zend_Controller_Plugin_Abstract
{
    /**
     * Constructor
     * 
     * @param  string $basePath Base path of application
     * @param  string $env Application environment
     * @return void
     */
    public function __construct($basePath, $env = 'production')
    {
        $this->env      = $env;

        $this->basePath = $basePath;
        $this->appPath  = $this->basePath . '/application';
        $this->libPath  = $this->basePath . '/library';
        $this->pubPath  = $this->basePath . '/public';
        $this->front    = Zend_Controller_Front::getInstance();
    }

    /**
     * Route Startup handler
     * 
     * @param  Zend_Controller_Request_Abstract $request 
     * @return void
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->initConfig()
             ->initControllers()
             ->initLog()
             ->initCache()
             ->initDb()
             ->initView();
    }

    /**
     * Initialize configuration
     * 
     * @return My_Plugin_Initialize
     */
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

    /**
     * Initialize controller directories
     * 
     * @return My_Plugin_Initialize
     */
    public function initControllers()
    {
        $this->front->setControllerDirectory($this->appPath . '/controllers', 'default');
        return $this;
    }

    /**
     * Initialize logger(s)
     * 
     * @return My_Plugin_Initialize
     */
    public function initLog()
    {
        $writer = new Zend_Log_Writer_Firebug();
        $log    = new Zend_Log($writer);

        $writer->setPriorityStyle(8, 'TABLE');
        $log->addPriority('TABLE', 8);

        Zend_Registry::set('log', $log);
        return $this;
    }

    /**
     * Initialize caching
     * 
     * @return My_Plugin_Initialize
     */
    public function initCache()
    {
        $config = $this->config->cache;
        $this->cache = $this->_getCache($config);
        Zend_Registry::set('cache', $this->cache);
        return $this;
    }

    /**
     * Initialize database
     * 
     * @return My_Plugin_Initialize
     */
    public function initDb()
    {
        $config   = $this->config->db;
        $cache    = $this->_getCache($config->cache);
        $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
        $db       = Zend_Db::factory($config->cxn);

        $profiler->setEnabled(true);
        $db->setProfiler($profiler);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);

        return $this;
    }

    /**
     * Initialize view and layouts
     * 
     * @return My_Plugin_Initialize
     */
    public function initView()
    {
        $layout = Zend_Layout::startMvc(array(
            'layoutPath' => $this->appPath . '/layouts/scripts'
        ));

        $view = $layout->getView();
        $view->addHelperPath('My/View/Helper/', 'My_View_Helper');

        $view->headLink()->appendStylesheet('/style/paste.css');

        Zend_Dojo::enableView($view);
        $view->doctype('XHTML1_TRANSITIONAL');
        $view->headTitle('Pastebin');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        $view->dojo()->setDjConfigOption('usePlainJson', true)
                     // ->setDjConfigOption('isDebug', true)
                     ->addStylesheetModule('dijit.themes.tundra')
                     ->addStylesheet('/js/dojox/grid/_grid/tundraGrid.css')
                     ->registerModulePath('../paste', 'paste')
                     ->setLocalPath('/js/dojo/dojo.js')
                     // ->addLayer('/js/paste/paste.js')
                     ->requireModule('paste.main')
                     ->addJavascript('paste.main.init();')
                     ->disable();

        return $this;
    }

    /**
     * Retrieve cache object based on configuration
     * 
     * @param  Zend_Config $config 
     * @return Zend_Cache
     */
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
