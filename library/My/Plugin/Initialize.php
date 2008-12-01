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
    public function __construct($env = 'production')
    {
        $this->env   = $env;
        $this->initConfig();
    }

    /**
     * Route Startup handler
     * 
     * @param  Zend_Controller_Request_Abstract $request 
     * @return void
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->front = Zend_Controller_Front::getInstance();
        $this->initControllers()
             ->initHelpers()
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
        $configMaster = new Zend_Config_Ini(APPLICATION_PATH . '/config/site.ini', $this->env);
        $configMaster = $configMaster->toArray();

        $ri      = new DirectoryIterator(APPLICATION_PATH . '/modules');
        $modules = array();
        foreach ($ri as $file) {
            if (!$file->isDir() || $file->isDot()) {
                continue;
            }
            $modules[$file->getFileName()] = $file->getRealPath();
        }

        foreach ($modules as $module => $path) {
            $configPath = $path . '/config/' . $module . '.ini';
            if (file_exists($configPath)) {
                $config = new Zend_Config_Ini($configPath, $this->env);
                $configMaster = array_merge($configMaster, $config);
            }
        }

        $this->config = new Zend_Config($configMaster);
        Zend_Registry::set('config', $this->config);
        return $this;
    }

    /**
     * Initialize controller directories
     * 
     * @return My_Plugin_Initialize
     */
    public function initControllers()
    {
        $this->front->setControllerDirectory($this->config->appPath . '/controllers', 'default');
        $this->front->addModuleDirectory($this->config->appPath . '/modules');
        return $this;
    }

    /**
     * Initialize action helpers
     * 
     * @return My_Plugin_Initialize
     */
    public function initHelpers()
    {
        Zend_Controller_Action_HelperBroker::addHelper(new My_Controller_Helper_ResourceLoader());
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

        $profiler->setEnabled($config->profiler->enabled);
        $db->setProfiler($profiler);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);

        return $this;
    }

    /**
     * Initialize view and layouts
     * 
     * @param  bool $doLayout
     * @return My_Plugin_Initialize
     */
    public function initView($doLayout = true)
    {
        $view = new Zend_View;
        $view->addHelperPath('My/View/Helper/', 'My_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/modules/spindle/views/helpers', 'Spindle_View_Helper');

        Zend_Dojo::enableView($view);
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative(true);
        $view->baseUrl = rtrim($this->getRequest()->getBaseUrl(), '/');
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('Pastebin');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        $view->dojo()->setDjConfigOption('preventBackButtonFix', false)
                     ->setDjConfigOption('isDebug', $this->config->view->dojo->isDebug)
                     ->setLocalPath('/js/dojo/dojo.js')
                     ->addLayer('/js/paste/layer.js')
                     ->registerModulePath('../paste', 'paste')
                     ->addStylesheetModule('paste.styles')
                     ->disable();

        Zend_Registry::set('view', $view);

        if ($doLayout) {
            $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
            $viewRenderer->setView($view);
            $layout = Zend_Layout::startMvc(array(
                'layoutPath' => $this->config->appPath . '/layouts/scripts'
            ));
        }

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
