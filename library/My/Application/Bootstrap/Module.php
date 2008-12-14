<?php
abstract class My_Application_Bootstrap_Module extends My_Application_Bootstrap_Base
{
    protected $_resourceLoader;

    public function setResourceLoader(My_Loader_Resource $loader)
    {
        $this->_resourceLoader = $loader;
        return $this;
    }

    public function getResourceLoader()
    {
        if (null === $this->_resourceLoader) {
            $class = get_class($this);
            if (preg_match('/^([a-z][a-z0-9]*)_Bootstrap$/i', $class, $matches)) {
                $prefix = $matches[1];
                $r = new ReflectionClass($this);
                $path = $r->getFileName();
                $this->setResourceLoader(new My_Loader_Resource(array(
                    'prefix' => $prefix,
                    'path'   => dirname($path),
                )));
            }
        }
        return $this->_resourceLoader;
    }
}
