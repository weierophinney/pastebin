<?php
class Bootstrap extends My_Application_Bootstrap_Base
{
    public $front;

    public function init()
    {
        $this->runInitializer('config');
        $this->front = Zend_Controller_Front::getInstance();
    }

    public function run()
    {
        $this->front->dispatch();
    }

    /**
     * Initialize configuration
     * 
     * @return My_Plugin_Initialize
     */
    public function initConfig()
    {
        $this->config = new Zend_Config_Ini(APPLICATION_PATH . '/config/site.ini', $this->getEnvironment(), true);
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
        $this->front->setControllerDirectory(APPLICATION_PATH . '/controllers', 'default');
        $this->front->addModuleDirectory(APPLICATION_PATH . '/modules');
        return $this;
    }

    public function initRequest()
    {
        $this->request = new Zend_Controller_Request_Http;
        $this->front->setRequest($this->request);
        return $this;
    }

    /**
     * Initialize action helpers
     * 
     * @return My_Plugin_Initialize
     */
    public function initHelpers()
    {
        Zend_Controller_Action_HelperBroker::addPrefix('My_Controller_Helper');
        Zend_Controller_Action_HelperBroker::getStaticHelper('ResourceLoader');
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

        $log->addWriter(new Zend_Log_Writer_Stream('/tmp/autoload.log'));


        $writer->setPriorityStyle(8, 'TABLE');
        $log->addPriority('TABLE', 8);

        Zend_Registry::set('log', $log);
        Phly_PubSub::subscribe('log', $log, 'info');
        return $this;
    }

    /**
     * Initialize caching
     * 
     * @return My_Plugin_Initialize
     */
    public function initCache()
    {
        $this->runInitializer('config');
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
        $this->runInitializer('config');
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
        $this->runInitializer('request');
        $view = new Zend_View;
        $view->addHelperPath('My/View/Helper/', 'My_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/modules/spindle/views/helpers', 'Spindle_View_Helper');

        Zend_Dojo::enableView($view);
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative(true);
        $view->baseUrl = rtrim($this->request->getBaseUrl(), '/');
        $view->doctype('XHTML1_STRICT');
        $view->headTitle()->setSeparator(' - ')->append('Spindle');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        $view->dojo()->setDjConfigOption('isDebug', $this->config->view->dojo->isDebug)
                     ->setLocalPath('/js/dojo/dojo.js')
                     ->registerModulePath('../spindle', 'spindle')
                     ->addStylesheetModule('spindle.themes.spindle')
                     ->requireModule('spindle.main')
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
     * Initialize module bootstraps
     * 
     * @return void
     */
    public function initModules()
    {
        $this->runInitializer('controllers');
        $this->runInitializer('log');
        $modules = $this->front->getControllerDirectory();

        foreach ($modules as $module => $dir) {
            if ('default' == $module) {
                continue;
            }
            $bootstrapFile = dirname($dir) . '/Bootstrap.php';
            $class         = ucfirst($module) . '_Bootstrap';
            if (Zend_Loader::loadFile('Bootstrap.php', dirname($dir))
                && class_exists($class)
            ) {
                $bootstrap = new $class($this);
                $bootstrap->bootstrap();
            }
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
