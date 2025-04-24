<?php
require(__DIR__ . '/../models/productsModel.php');
class ProductsController {
    private $productsModel;

    function __construct() {
        $this->productsModel = new ProductsModel();
        $baseConnectionErrMsg = $this->productsModel->conenct();
        if($baseConnectionErrMsg) {
            $this->errorMessage($baseConnectionErrMsg);
        }
        $this->products();
    }

    function products() {
        $_SESSION['products'] = $this->productsModel->getAllProducts();
    }
    function errorMessage($errorMsg) {
       $_SESSION['errorMsg'] = $errorMsg;
       var_dump($_SESSION['errorMsg']);
       exit();
    }
    
}

new ProductsController();

?>