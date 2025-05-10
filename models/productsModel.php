<?php
require_once(__DIR__ . '/DatabaseModel.php');
require_once(__DIR__ . '/../controllers/AppController.php');
class ProductsModel  {
    public function productQueryExecutor($execData) {
        return DatabaseModel::queryExec($execData);
    }
}

?>