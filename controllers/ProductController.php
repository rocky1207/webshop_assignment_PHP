<?php
require_once __DIR__."/./AppController.php";
require_once __DIR__."/../models/ProductModel.php";
class ProductController {
    public  $productId;
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
        $productmodel = new ProductModel();
        $product = $productmodel->getProduct($this->productId);
        $_SESSION["product"] = $product;
    }    
    
}
?>