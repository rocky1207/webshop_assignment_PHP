<?php
require_once(__DIR__ . '/../models/ProductsModel.php');
require_once(__DIR__ . '/AppController.php');
class GetProductsController {
    private $productsModel;

    function __construct() {
         try {
            AppController::databaseConnect();
            $this->products();
        } catch (Exception $e) {
             AppController::createMessage($e->getMessage(), "page=home");
        }
    }

    function products() {
        $execData = [
            "query" => "SELECT * FROM proizvodi",
            "errorMsgOne" => AppController::NO_PRODUCTS_MESSAGE,
            "erroreMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        $this->productsModel = new ProductsModel();
        $products = $this->productsModel->productQueryExecutor($execData);
        //if(is_string($products)) {
         //   AppController::createMessage($products, "page=products");
       // } else {
            $_SESSION['products'] = $products;
       // }
    }
}

new GetProductsController();

?>