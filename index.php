<?php
session_start();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$page = $_GET['page'] ?? 'home';
$message = $_SESSION["message"] ?? '';


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
        case 'delete-product':
            require_once(__DIR__."/controllers/DeleteProductController.php");
            $deleteProductController = new DeleteProductController();
            $deleteProductController->deleteProduct();
            break;
        case 'update-product':
        require_once(__DIR__."/controllers/UpdateProductController.php");
            $updateProductController = new UpdateProductController();
            $updateProductController->updateProduct();
        break;
    }
}

if($requestMethod === 'GET') {
     
    switch($page) {
        case 'products':
            if($isLoggedIn) {
                require_once "./controllers/GetProductsController.php";
                $getProductsController = new GetProductsController();
                $getProductsController->getProducts();
                require './view/pages/products.php';
            }
            break;
        case 'logIn':
            !$isLoggedIn && require './view/pages/logIn.php';
            break;
        case 'logOut':
            if($isLoggedIn) {
                require_once "./controllers/LogOutController.php";
                $logOutController = new LogOutController();
                $logOutController->logOut();
            }
            break;
        case 'register':
            require './view/pages/register.php';
            break;
        case 'aboutUs':
            require './view/pages/aboutUs.php';
            break;
        case 'product':
            if($isLoggedIn) {
                if(!$message) {
                    require_once "./controllers/GetProductController.php";
                    $getProductController = new GetProductController();
                    $getProductController->getProduct("page=product");
                }
            require './view/pages/product/show.php';
            }
            break;
        case 'add-product':
            $isLoggedIn && require './view/pages/addProduct.php';
            break;
        case 'search-product':
        if($isLoggedIn)  {
            require_once "./controllers/SearchProductController.php";
            $searchProductController = new SearchProductController();
            $searchProductController->searchProduct();
            require './view/pages/products.php';
        break;
        }
        case 'update-product':
        if($isLoggedIn)  {
            if(!$message) {
            require_once "./controllers/GetProductController.php";
            $getProductController = new GetProductController();
            $getProductController->getProduct("page=update-product");
            }
            require './view/pages/product/update.php';
        break;
        } 
        case 'home':
        default:
            require './view/pages/home.php';
    }
}
?>