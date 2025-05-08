<?php
require_once(__DIR__ . '/DatabaseModel.php');
require_once(__DIR__ . '/../controllers/AppController.php');
class ProductsModel  {
    public function getAllProducts($execData) {
       /* $execData = [
            "query" => "SELECT * FROM proizvodi",
            "errorMsgOne" => AppController::NO_PRODUCTS_MESSAGE,
            "erroreMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        */
        return DatabaseModel::queryExec($execData);
    }
    public function getProduct($execData) {
        /*
        $execData = [
            "query" => "SELECT * from proizvodi WHERE id = :id",
            "data" => [
                "key" => "id",
                "id" => $id
            ],
            "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
            "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        */
        return DatabaseModel::queryExec($execData);
    }
    public function addProduct($execData) {
        /*
        $execData = [
            "query" => "INSERT INTO proizvodi (ime, opis, cena, slika, kolicina) VALUES (:name, :description, :price, :image, :quantity)",
            "data" => [
                "key" => "id",
            ],
            "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
            "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        */
        return DatabaseModel::queryExec($execData);
    }
    public function productQueryExecutor($execData) {
        return DatabaseModel::queryExec($execData);
    }
}

?>