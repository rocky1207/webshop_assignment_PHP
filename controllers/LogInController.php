<?php
require_once __DIR__ . '/AppController.php';
require_once __DIR__ . '/../models/DatabaseModel.php';
class LogInController {
    
    public function login() {
        $inputs = ['email' => $_POST['email'], 'password' => $_POST['password']];
        $regex = ['email' => AppController::EMAIL_REGEX, 'password' => AppController::PASSWORD_REGEX];
        $messages =  ['email' => AppController::EMAIL_ERROR_MESSAGE, 'password' => AppController::PASSWORD_ERROR_MESSAGE];
        $data = AppController::validateInputs($inputs, $regex, $messages, "page=logIn");
        
        if(!empty($data)) {
            $execData = [
                "keys" => ["email"],
                "data" => [
                    "email" => $data["email"],
                    "password" => $data["password"]
                ],
                "query" => "SELECT * FROM korisnici WHERE email LIKE :email",
                "errorMsgOne" => AppController::EMAIL_ERROR_MESSAGE,
                "errorMsgTwo" => AppController::WRONG_PASSWORD_MESSAGE,
                "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            try {
                AppController::databaseConnect();
                if(isset($execData)) {
                    $user = DatabaseModel::queryExec($execData);
                    $user && $_SESSION["isLoggedIn"] = true;
                    session_regenerate_id(true);
                    Header("Location: ?page=products");
                }
            } catch(Exception $e) {
                AppController::createMessage($e->getMessage(), "page=logIn");
            }
        }
        
        
    }
}

?>