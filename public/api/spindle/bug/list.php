<?php
require_once dirname(__FILE__) . '/bootstrap.php';

$bootstrap = Zend_Registry::get('bootstrap');
$bootstrap->initDb();

$loader = new My_Controller_Helper_ResourceLoader;
$loader->initModule('spindle');

$request  = $bootstrap->request;
$model    = new Spindle_Model_BugTracker();

$url      = $request->getBaseUrl();
$segments = explode('/', $url);
$type     = array_pop($segments);

if (!in_array($type, array('open', 'resolved', 'all'))) {
    $type = 'all';
}
$method   = 'fetch' . ucfirst($type) . 'Bugs';
$offset   = $request->getParam('start', 0);
$limit    = $request->getParam('count', 30);

if ($sort = $request->getParam('sort', false)) {
    $dir = 'ASC';
    if ('-' == substr($sort, 0, 1)) {
        $sort = substr($sort, 1);
        $dir = 'DESC';
    }
    $model->setSortOrder($sort, $dir);
}

$dojoData = new Zend_Dojo_Data('id', $model->$model($offset, $limit), 'id');
/* @todo Need to add methods for *COUNTING* total results */
// $dojoData->setMetadata('count', $model->fetchActiveCount());

header('Content-Type: application/json');
echo $dojoData;
