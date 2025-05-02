<?php
require_once(__DIR__ . '/DatabaseModel.php');
require(__DIR__ . '/../controllers/AppController.php');
class ProductsModel  {
    function getAllProducts() {
        $execData = [
            "query" => "SELECT * FROM proizvodi",
            "errorMsgOne" => AppController::NO_PRODUCTS_MESSAGE,
            "erroreMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        
        return DatabaseModel::queryExec($execData);
    }
}

?>