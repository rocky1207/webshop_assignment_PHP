<?php
session_start();
$requestMethod = $_SERVER['REQUEST_METHOD'];
$page = $_GET['page'] ?? 'home';
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;

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