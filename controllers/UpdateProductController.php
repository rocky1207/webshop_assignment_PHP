<?php
require_once (__DIR__."/AppController.php");
require_once (__DIR__."/../models/ProductsModel.php");
class UpdateProductController {
    public function updateProduct() {
        $inputs = [
            "productId" => $_GET["id"],
            "product" => $_POST["product"],
            "description" => $_POST["description"],
            "price" => (int)$_POST["price"],
            "image" => $_POST["image"],
            "quantity" => (int)$_POST["quantity"]
        ];
        $regex = [
            "productId" => AppController::PRODUCT_ID_REGEX,
            "product" => AppController::DESCRIPTION_REGEX,
            "description" => AppController::DESCRIPTION_REGEX,
            "price" => AppController::NUMBER_REGEX,
            "image" => AppController::IMAGE_REGEX,
            "quantity" => AppController::NUMBER_REGEX
        ];
        $messages = [
            "productId" => AppController::PRODUCT_ID_ERROR_MESSAGE,
            "product" => AppController::DESCRIPTION_ERROR_MESSAGE,
            "description" =>AppController::DESCRIPTION_ERROR_MESSAGE,
            "price" => AppController::NUMBER_ERROR_MESSAGE,
            "image" => AppController::IMAGE_ERROR_MESSAGE,
            "quantity" => AppController::NUMBER_ERROR_MESSAGE
        ];
        
        $data = AppController::validateInputs($inputs, $regex, $messages, "page=update-product");
        
        if(!empty($data)) {
            $execData = [
                "query" => "UPDATE proizvodi SET ime = :product, opis = :description, cena = :price, slika = :image, kolicina = :quantity WHERE id = :id",
                "data" => [
                    "id" => (int)$data["productId"],
                    "product" => $data["product"],
                    "description" => $data["description"],
                    "price" => $data["price"],
                    "image" => $data["image"],
                    "quantity" => $data["quantity"],
                ],
                "errorMsgOne" => "Greška pri ažuriranju proizvoda.",
                "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            try {
                AppController::databaseConnect();
                $productsModel = new ProductsModel();
                $productsModel->productQueryExecutor($execData);
                Header("Location: ?page=update-product&id={$data["productId"]}");
            } catch(Exception $e) {
                AppController::createMessage($e->getMessage(), "page=update-product");
            }
        }
    }
}
?>