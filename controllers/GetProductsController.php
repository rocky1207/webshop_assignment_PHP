<?php
require_once(__DIR__ . '/../models/ProductsModel.php');
require_once(__DIR__ . '/AppController.php');
class GetProductsController {
    function getProducts() {
        $execData = [
            "query" => "SELECT * FROM proizvodi",
            "errorMsgOne" => AppController::NO_PRODUCTS_MESSAGE,
            "erroreMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        try {
            AppController::databaseConnect();
            $productsModel = new ProductsModel();
            $products = $productsModel->productQueryExecutor($execData);
            $_SESSION['products'] = $products;
        } catch (Exception $e) {
             AppController::createMessage($e->getMessage(), "page=home");
        }
    }
}

?>