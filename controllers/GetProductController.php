<?php
require_once __DIR__."/./AppController.php";
require_once __DIR__."/../models/ProductsModel.php";
class GetProductController {
    
    public function getProduct($page) {
        $inputs = ["productId" => $_GET["id"]];
        $regex = ["productId" => AppController::PRODUCT_ID_REGEX];
        $messages = ["productId" => AppController::PRODUCT_ID_ERROR_MESSAGE];
        $data = AppController::validateInputs($inputs, $regex, $messages, $page);
            if(!empty($data)) {
                try {
                    AppController::databaseConnect();
                    $execData = [
                        "query" => "SELECT * from proizvodi WHERE id = :id",
                        "keys" => ["id"],
                        "data" => ["id" => (int)$data["productId"]],
                        "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
                        "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
                    ];
                    $productmodel = new ProductsModel();
                    $product = $productmodel->productQueryExecutor($execData);
                    $_SESSION["product"] = $product;
                } catch(Exception $e) {
                    AppController::createMessage($e->getMessage(), $page);
            }
        }
    }    
}
?>