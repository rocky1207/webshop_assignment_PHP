<?php
require(__DIR__ . '/../models/ProductsModel.php');
require_once(__DIR__ . '/AppController.php');
class ProductsController {
    private $productsModel;

    function __construct() {
         try {
            DatabaseModel::connect();
            $this->products();
        } catch (Exception $e) {
             AppController::createMessage($e->getMessage(), "page=home");
        }
    }

    function products() {
        $this->productsModel = new ProductsModel();
        $products = $this->productsModel->getAllProducts();
        if(is_string($products)) {
            AppController::createMessage($products, "page=products");
        } else {
            $_SESSION['products'] = $products;
        }
    }
}

new ProductsController();

?>