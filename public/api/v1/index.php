<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$log = new Zend_Log(new Zend_Log_Writer_Stream('/tmp/api.log'));

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
    $log->info("Failed to answer request for $file");
    exit;
}
$log->info("Answering request for $file");

$plugin->initView()
       ->initDb();
$model = new Paste();
$view  = Zend_Registry::get('view');

$view->addBasePath(APPLICATION_PATH . '/views');
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
$log->info("Preparting to write to $fileName");
if (('production' == APPLICATION_ENV) && is_writeable(dirname($fileName))) {
    file_put_contents($fileName, $content);
    $log->info("Wrote to $fileName");
}
echo $content;
