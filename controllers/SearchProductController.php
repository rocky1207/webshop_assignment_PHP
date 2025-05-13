<?php 
require_once(__DIR__."/AppController.php");
require_once(__DIR__."/../models/ProductsModel.php");
class SearchProductController {
    public function searchProduct() {
        $inputs = ["search" => $_GET["search"]];
        $regex = ["search" => AppController::SEARCH_REGEX];
        $messages = ["search" => ''];
        $data = AppController::validateInputs($inputs, $regex, $messages, "?page=products");
        
        if(!empty($data)) {
            try {
                AppController::databaseConnect();
                $execData = [ 
                "query" => "SELECT * FROM proizvodi WHERE ime LIKE :name 
                OR opis LIKE :description 
                OR cena LIKE :price 
                OR kolicina LIKE :quantity",
                "keys" => ["name", "description", "price", "quantity"],
                "data" => [
                    "name" => "%" . $data['search'] . "%",
                    "description" => "%" . $data['search'] . "%",
                    "price" => "%" . $data['search'] . "%",
                    "quantity" => "%" . $data['search'] . "%",
                ],
                "errorMsgOne" => AppController::NO_PRODUCTS_MESSAGE,
                "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            if(isset($execData)) {
                $productsModel = new ProductsModel();
                $products = $productsModel->productQueryExecutor($execData);
            }
            } catch(Exception $e) {
                AppController::createMessage($e->getMessage(), "page=products");
            }
        }

        header('Content-Type: application/json');
        echo json_encode($products);
        exit;
        
    }
}
?>