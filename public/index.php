<?php

if (session_status() === PHP_SESSION_NONE) 
{
    session_start();
}

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

if (!isset($_SESSION['user']) && !($controller === 'auth' && $action === 'login')) 
{
    header("Location: /Phonexa-MVC/Login");
    exit;
}

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "../app/controllers/" . $controllerName . ".php";

if (file_exists($controllerFile)) 
{
    require_once $controllerFile;

    $controllerObject = new $controllerName();

    if (method_exists($controllerObject, $action)) 
    {
        $controllerObject->$action();
    } 
    else 
    {
        echo "Action not found";
    }
} 
else 
{
    echo "Controller not found";
}
