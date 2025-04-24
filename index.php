<?php
session_start();
$page = $_GET['page'] ?? 'home';

switch($page) {
    case 'products':
        require_once "./controllers/productsController.php";
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

?>