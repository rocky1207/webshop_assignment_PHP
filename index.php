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
    }
}

if($requestMethod === 'GET') {
     
    switch($page) {
        case 'products':
            require_once "./controllers/ProductsController.php";
            new ProductsController();
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
        case 'home':
        default:
            require './view/pages/home.php';
    }
}



?>