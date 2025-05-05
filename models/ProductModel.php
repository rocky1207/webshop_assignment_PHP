<?php
require_once __DIR__."/DatabaseModel.php";
class ProductModel {
    public function getProduct($id) {
        $execData = [
            "query" => "SELECT * from proizvodi WHERE id = :id",
            "data" => [
                "key" => "id",
                "id" => $id
            ],
            "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
            "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        return DatabaseModel::queryExec($execData);
    }
}
?>