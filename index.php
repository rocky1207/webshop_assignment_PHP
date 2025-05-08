<?php
session_start();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$page = $_GET['page'] ?? 'home';

if($requestMethod === 'POST') {
    
    switch($page) {
        case 'logIn':
            require_once "./controllers/LogInController.php";
            $logInController = new LogInController();
            $logInController->login();
            break;
        case 'register':
            require_once "./controllers/RegisterController.php";
            $registerController = new RegisterController();
            $registerController->register();
            break;
        case 'add-product':
            require_once (__DIR__."/controllers/AddProductController.php");
            $addProductController = new AddProductController();
            $addProductController->createProduct();
            break;
    }
}

if($requestMethod === 'GET') {
     
    switch($page) {
        case 'products':
            require_once "./controllers/GetProductsController.php";
            new GetProductsController();
            require './view/pages/products.php';
            break;
        case 'logIn':
            require './view/pages/logIn.php';
            break;
        case 'logOut':
            require_once "./controllers/LogOutController.php";
            $logOutController = new LogOutController();
            $logOutController->logOut();
            break;
        case 'register':
            require './view/pages/register.php';
            break;
        case 'aboutUs':
            require './view/pages/aboutUs.php';
            break;
        case 'product':
            if($isLoggedIn) {
                require_once "./controllers/GetProductController.php";
            new GetProductController();
            require './view/pages/product/show.php';
            }
            break;
        case 'add-product':
            $isLoggedIn && require './view/pages/addProduct.php';
            break;
        case 'home':
        default:
            require './view/pages/home.php';
    }
}



?>