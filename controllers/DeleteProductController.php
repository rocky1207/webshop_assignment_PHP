<?php
require_once(__DIR__."/AppController.php");
require_once(__DIR__."/../models/ProductsModel.php");
class DeleteProductController {
    public function deleteProduct() {
        $inputs = ["productId" => $_POST['id']];
        $regex = ["productId" => AppController::PRODUCT_ID_REGEX];
        $messages = ["productId" => AppController::PRODUCT_ID_ERROR_MESSAGE];

        $id = AppController::validateInputs($inputs, $regex, $messages, "page=products");
        if(!empty($id)) {
            $productId = (int)$id["productId"];
            $execData = [
                "query" => "SELECT * FROM proizvodi WHERE id = :id",
                "keys" => ["id"],
                "data" => [
                    "id" => $productId
                ],
                "errorMsgOne" => "Proizvod ne postoji u bazi podataka.",
                "erroreMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            try {
                AppController::databaseConnect();
                $productsModel = new ProductsModel();
                $data = $productsModel->productQueryExecutor($execData);
                if(!empty($data)) {
                $execDataDelete = [
                "query" => "DELETE FROM proizvodi WHERE id = :id",
                "data" => ["id" => $productId],
                "errorMsgOne" => "Proizvod trenutno nije moguće obrisati.",
                "erroreMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            $productsModel->productQueryExecutor($execDataDelete);
            Header("Location: ?page=products");
            }
            } catch (Exception $e) {
                AppController::createMessage($e->getMessage(), "page=products");
            }
        }
    }
}
?>