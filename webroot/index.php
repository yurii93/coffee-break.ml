<?php

session_start();

require_once 'settings.php';
require_once 'includes.php';

mb_internal_encoding("UTF-8");

date_default_timezone_set(TIME_ZONE);

$controller = 'Index';
$action = 'index';
$parameters = null;

if(isset($_GET['route'])) {

    $route = explode('/',$_GET['route']);

    if(isset($route[0])) {
        $controller = ucfirst($route[0]);
    }

    if(isset($route[1])) {
        $action = $route[1];

    }

    if(isset($route[2])) {
        $parameters = $route[2];
    }
    
}

if (file_exists(SITE_DIR . DS . "Controller" . DS . "{$controller}Controller" . '.php')) {
	
    $controllerName = "\\Controller\\" . $controller . "Controller";

} else {
	
    $controllerName = "\\Controller\\IndexController";
}

$controllerObj = new $controllerName();

if (is_callable(array($controllerObj, $action))) {

    $controllerObj->$action($parameters);

} else {

    $controllerObj->index();
}