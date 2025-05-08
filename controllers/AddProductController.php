<?php
require_once (__DIR__."/AppController.php");
require_once (__DIR__."/../models/ProductsModel.php");
class AddProductController {
    public function createProduct() {
        $inputs = [
            "product" => $_POST["product"],
            "description" => $_POST["description"],
            "price" => $_POST["price"],
            "image" => $_POST["image"],
            "quantity" => $_POST["quantity"]
        ];
        $regex = [
            "product" => AppController::TEXT_REGEX,
            "description" => AppController::DESCRIPTION_REGEX,
            "price" => AppController::NUMBER_REGEX,
            "image" => AppController::IMAGE_REGEX,
            "quantity" => AppController::NUMBER_REGEX
        ];
        $messages = [
            "product" => AppController::TEXT_ERROR_MESSAGE,
            "description" =>AppController::DESCRIPTION_ERROR_MESSAGE,
            "price" => AppController::NUMBER_ERROR_MESSAGE,
            "image" => AppController::IMAGE_ERROR_MESSAGE,
            "quantity" => AppController::NUMBER_ERROR_MESSAGE
        ];
       
        $data = AppController::validateInputs($inputs, $regex, $messages, "page=add-product");
        $_SESSION["data"] = $data;
        if($data) {
            $execData = [
                "query" => "INSERT INTO proizvodi (ime, opis, cena, slika, kolicina) VALUES (:product, :description, :price, :image, :quantity)",
                "data" => [
                    "product" => $data["product"],
                    "description" => $data["description"],
                    "price" => $data["price"],
                    "image" => $data["image"],
                    "quantity" => $data["quantity"],
                ],
                "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
                "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            try {
                AppController::databaseConnect();
            } catch(Exception $e) {
                AppController::createMessage($e->getMessage(), "?page=add-product");
            }
            
            $productsModel = new ProductsModel();
            $productsModel->productQueryExecutor($execData);
            Header("Location: ?page=add-product");
        }
    }
}
?>