<?php

if (session_status() === PHP_SESSION_NONE) 
{
    session_start();
}

$request = $_SERVER['REQUEST_URI'];

$base = "/Phonexa-MVC/";
$route = str_replace($base, "", $request);
$route = trim($route, "/");

$segments = explode("/", $route);

$page = $segments[0] ?? "Login";
$id   = $segments[1] ?? null;

$publicPages = ["", "Home","Login", "ProductDetail", "FilterBrand", "SearchBrand"];

if (!isset($_SESSION['user']) && !in_array($page, $publicPages))
{
    header("Location: /Phonexa-MVC/Login");
    exit;
}

switch ($page)
{ 
    case "":
        $controller = "home";
        $action = "index";
        break;

    case "Home":
        $controller = "home";
        $action = "index";
        break;
    
    case "Dashboard":
        $controller = "admin";
        $action = "dashboard";
        break;

    case "Profile":
        $controller = "admin";
        $action = "profile";
        break;

    case "ProductList":
        $controller = "product";
        $action = "index";
        break;

    case "AddProduct":
        $controller = "product";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $action = "store";
        } 
        else 
        {
            $action = "create";
        }
        break;

    case "EditProduct":
        $controller = "product";
        $action = "edit";
        $_GET['id'] = $id;
        break;

    case "UpdateProduct":
        $controller = "product";
        $action = "update";
        break;

    case "ViewProduct":
        $controller = "product";
        $action = "view";
        $_GET['id'] = $id;
        break;

    case "DeleteProduct":
        $controller = "product";
        $action = "delete";
        $_GET['id'] = $id;
        break;

    case "BrandList":
        $controller = "brand";
        $action = "index";
        break;
    
    case "AddBrand":
        $controller = "brand";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $action = "store";
        } 
        else 
        {
            $action = "create";
        }
        break;

    case "EditBrand":
        $controller = "brand";
        $action = "edit";
        $_GET['id'] = $id;
        break;

    case "UpdateBrand":
        $controller = "brand";
        $action = "update";
        break;

    case "ViewBrand":
        $controller = "brand";
        $action = "view";
        $_GET['id'] = $id;
        break;

    case "DeleteBrand":
        $controller = "brand";
        $action = "delete";
        $_GET['id'] = $id;
        break;

    case "Login":
        $controller = "auth";
        $action = "login";
        break;

    case "Logout":   
        $controller = "auth";
        $action = "logout";
        break;

    case "FilterBrand":
        $controller = "product";
        $action = "filterByBrand";
        break;

    case "SearchBrand":
        $controller = "product";
        $action = "searchBrand";
        break;

    case "ProductDetail":
        $controller = "product";
        $action = "detail";
        $_GET['id'] = $id;
        break;

    default:
        header("Location: /Phonexa-MVC/Login");
        exit;;
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

