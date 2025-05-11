<?php
require_once __DIR__."/./AppController.php";
require_once __DIR__."/../models/ProductsModel.php";
class GetProductController {
    public $productId;
    public function __construct() {
        $this->productId = $_GET["id"];
        $_SESSION["id"] = $this->productId;
        try {
            AppController::databaseConnect();
        } catch (Exception $e) {
            AppController::createMessage($e->getMessage(), "page=product");
        }
        $this->product();
    }
    
    public function product() {
        $execData = [
            "query" => "SELECT * from proizvodi WHERE id = :id",
            "keys" => ["id"],
            "data" => [
                "id" => $this->productId
            ],
            "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
            "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
        ];
        $productmodel = new ProductsModel();
        $product = $productmodel->productQueryExecutor($execData);
        $_SESSION["product"] = $product;
    }    
}
?>