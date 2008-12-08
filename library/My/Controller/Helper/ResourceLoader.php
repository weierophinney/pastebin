<?php
/**
 * Resource loader action helper
 * 
 * @uses       Zend_Controller_Action_Helper_Abstract
 * @package    My
 * @subpackage Controller
 * @copyright  Copyright (C) 2008 - Matthew Weier O'Phinney
 * @author     Matthew Weier O'Phinney <matthew@weierophinney.net> 
 * @license    New BSD {@link http://framework.zend.com/license/new-bsd}
 * @version    $Id: $
 */
class My_Controller_Helper_ResourceLoader extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var array Valid loader methods
     */
    protected $_loaderMethods;

    /**
     * @var My_Loader_Resource
     */
    protected $_resourceLoader;

    /**
     * Initialize resource loader
     * 
     * @param  null|My_Loader_Resource
     * @return void
     */
    public function __construct($resourceLoader = null)
    {
        if ($resourceLoader instanceof My_Loader_Resource) {
            $this->setResourceLoader($resourceLoader);
        }
    }

    /**
     * Proxy to resource loader methods
     * 
     * @param mixed $method 
     * @param mixed $args 
     * @return void
     */
    public function __call($method, $args)
    {
        $loader = $this->getResourceLoader();
        if (!method_exists($loader, $method)) {
            throw new My_Exception(sprintf('Method "%s" does not exist in class %s', $method, __CLASS__));
        }
        return call_user_func_array(array($loader, $method), $args);
    }

    /**
     * Set resource loader
     *
     * @param  My_Loader_Resource $resourceLoader
     * @return My_Controller_Helper_ResourceLoader
     */
    public function setResourceLoader(My_Loader_Resource $resourceLoader)
    {
        $this->_resourceLoader = $resourceLoader;
        return $this;
    }

    /**
     * Retrieve resource loader
     *
     * If no loader is registered and a 'ResourceLoader' registry key is 
     * present, pulls from the registry. If none registered, instantiates an 
     * instance.
     *
     * @return My_Loader_Resource
     */
    public function getResourceLoader()
    {
        if (null === $this->_resourceLoader) {
            if (Zend_Registry::isRegistered('ResourceLoader')) {
                $this->setResourceLoader(Zend_Registry::get('ResourceLoader'));
            } else {
                $this->setResourceLoader(new My_Loader_Resource);
            }
        }
        return $this->_resourceLoader;
    }

    /**
     * Initialize paths for current module
     * 
     * @return void
     */
    public function init()
    {
        if (!$this->getActionController()) {
            return;
        }

        $module = $this->getRequest()->getModuleName();
        $dir    = $this->getFrontController()->getModuleDirectory($module);
        $this->initModule($module, $dir);
    }

    /**
     * Initialize prefix paths for a given module, if necessary
     * 
     * @param  string $module 
     * @param  string|null $dir 
     * @return void
     */
    public function initModule($module, $dir = null)
    {
        if (null === $dir) {
            $dir = APPLICATION_PATH . '/modules/' . $module;
        }

        foreach ($this->getResourceLoader()->getLoaders() as $type => $loader) {
            $prefix = ucfirst($module) . '_';
            switch ($type) {
                case 'dbtable':
                    $prefix .= 'Model_DbTable';
                    $path    = '/models/DbTable';
                    break;
                case 'model':
                    $prefix .= 'Model';
                    $path    = '/models';
                    break;
                case 'form':
                case 'service':
                    $prefix .= 'Model_' . ucfirst($type);
                    $path    = '/models/' . ucfirst($type);
                    break;
            }
            if (!$loader->getPaths($prefix)) {
                $loader->addPrefixPath($prefix, $dir . $path);
            }
        }
    }

    /**
     * Proxy to a resource loader method
     * 
     * @param  string $resource
     * @param  string $type
     * @return object
     */
    public function direct($resource, $type = 'model')
    {
        $loader = $this->getResourceLoader();
        if (null === $this->_loaderMethods) {
            $this->_loaderMethods = get_class_methods($loader);
        }

        $method = 'get' . ucfirst(strtolower($type));
        if (!in_array($method, $this->_loaderMethods)) {
            throw new Exception('Invalid resource type specified; must be one of (' . implode(', ', array_keys($this->getLoaders())) . ')');
        }

        return $loader->$method($resource, $type);
    }
}
