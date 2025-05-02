<?php
require_once __DIR__ . '/AppController.php';
require_once __DIR__ . '/../models/DatabaseModel.php';
class LogInController {
    
    public function login() {
        $inputs = ['email' => $_POST['email'], 'password' => $_POST['password']];
        $regex = ['email' => AppController::EMAIL_REGEX, 'password' => AppController::PASSWORD_REGEX];
        $messages =  ['email' => AppController::EMAIL_ERROR_MESSAGE, 'password' => AppController::PASSWORD_ERROR_MESSAGE];
        $data = AppController::validateInputs($inputs, $regex, $messages, "page=home");
        
        if($data) {
            $execData = [
                "data" => [
                    "key" => "email",
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
            } catch(Exception $e) {
                AppController::createMessage($e->getMessage(), "page=logIn");
            }
        }
        
        if($execData) {
            try {
                $user = DatabaseModel::queryExec($execData);
                $_SESSION["user"] = $user;
                $user && $_SESSION["isLoggedIn"] = true;
                $user && AppController::createMessage('Logovanje uspešno!', "page=products");
                session_regenerate_id(true);
            } catch (Exception $e) {
                AppController::createMessage($e->getMessage(), "page=logIn");
            }
        }
        
        
    }
}

?>