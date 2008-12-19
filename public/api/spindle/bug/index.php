<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$bootstrap = Zend_Registry::get('bootstrap');
$request   = $bootstrap->request;
$file      = $request->getPathInfo();
$matches   = false;

$whitelist = array(
    '/content/open-grid.html',
    '/content/resolved-grid.html',
    '/content/all-grid.html',
);

if (!in_array($file, $whitelist)) {
    header('HTTP/1.0 501 Not Implemented');
    echo "<h1>501 - Not Implemented</h1>";
    echo "<p>Page requested: " . htmlentities($file) . "</p>";
    exit;
}

$bootstrap->initView()
          ->initDb();
$loader = new My_Controller_Helper_ResourceLoader;
$loader->initModule('spindle');

$model = $loader->getModel('Bug');
$view  = Zend_Registry::get('view');

$view->addBasePath(APPLICATION_PATH . '/views');
$view->addBasePath(APPLICATION_PATH . '/modules/spindle/views');
$view->baseUrl = Zend_Registry::get('baseUrl');
$view->model   = $model;

if (isset($matches) && $matches) {
    $view->id    = $matches[2];
    switch ($matches[1]) {
        default:
            $viewScript = '';
            break;
    }
} else {
    $base = basename($file);
    $view->type = substr($base, 0, strpos($base, '-'));
    $viewScript = 'bug/content/grid.phtml';
}

$content = $view->render($viewScript);
$fileName = realpath(dirname(__FILE__)) . $file;
if (('production' == APPLICATION_ENV) && is_writeable(dirname($fileName))) {
    file_put_contents($fileName, $content);
}
echo $content;
