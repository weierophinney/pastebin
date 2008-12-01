<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$plugin  = Zend_Registry::get('init');
$request = $plugin->getRequest();
$file    = $request->getPathInfo();
$matches = false;

if (!in_array($file, array('/content/about.html', '/content/active-grid.html', '/content/new-paste.html'))
    && !preg_match('#/(paste|followup)-([a-z0-9]{13})\.html$#i', $file, $matches)
) {
    header('HTTP/1.0 501 Not Implemented');
    echo "<h1>501 - Not Implemented</h1>";
    echo "<p>Page requested: " . htmlentities($file) . "</p>";
    exit;
}

$plugin->initView()
       ->initDb();
$loader = new My_Controller_Helper_ResourceLoader;
$loader->initModule('spindle');

$model = $loader->getModel('Paste');
$view  = Zend_Registry::get('view');

$view->addBasePath(APPLICATION_PATH . '/views');
$view->addBasePath(APPLICATION_PATH . '/modules/spindle/views');
$view->baseUrl = Zend_Registry::get('baseUrl');
$view->model   = $model;

if ($matches) {
    $view->id    = $matches[2];
    switch ($matches[1]) {
        case 'followup':
            $viewScript = 'paste/content/followup.phtml';
            break;
        case 'paste':
        default:
            $viewScript = 'paste/content/display.phtml';
            break;
    }
} else {
    $viewScript = 'paste' . str_replace('.html', '.phtml', $file);
}

$content = $view->render($viewScript);
$fileName = realpath(dirname(__FILE__)) . $file;
if (('production' == APPLICATION_ENV) && is_writeable(dirname($fileName))) {
    file_put_contents($fileName, $content);
}
echo $content;
