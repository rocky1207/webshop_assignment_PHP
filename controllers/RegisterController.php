<?php
require_once __DIR__.'/AppController.php';
require_once __DIR__.'/../models/DatabaseModel.php';
class RegisterController {
    public function register() {
        $inputs = [
            "email" => $_POST["email"], 
            "password" => $_POST["password"],
            "confirmPassword" => $_POST["confirmPassword"]
        ];
        $regex = [
            "email" => AppController::EMAIL_REGEX, 
            "password" => AppController::PASSWORD_REGEX,
            "confirmPassword" => AppController::PASSWORD_REGEX
        ];
        $messages = [
            "email" => AppController::EMAIL_ERROR_MESSAGE, 
            "password" => AppController::PASSWORD_ERROR_MESSAGE,
            "confirmPassword" => AppController::PASSWORD_ERROR_MESSAGE
        ];
        $data = AppController::validateInputs($inputs, $regex, $messages, "page=register");
        $data && $registerData = AppController::isPasswordEqual($data);
        
        if(!empty($registerData)) {
            $execData = [
                "checkType" => "emailExist",
                "keys" => ["email"],
                "data" => [
                    "email" => $registerData["email"],
                ],
                "query" => "SELECT * FROM korisnici WHERE email = :email",
                "errorMsgOne" => AppController::EMAIL_EXISTS_MESSAGE,
                "errorMsgTwo" => AppController::WRONG_PASSWORD_MESSAGE,
                "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
            ];
            try {
                AppController::databaseConnect();
                if(isset($execData)) {
                    DatabaseModel::queryExec($execData);
                    $execDataInsert = [
                        "query" => "INSERT INTO korisnici (email, lozinka) VALUES (:email, :password)",
                        "data" => [
                            "email" => $registerData["email"],
                            "password" => password_hash($registerData["password"], PASSWORD_DEFAULT)
                        ],
                        "errorMsgOne" => "Trenutno nije moguće izvršiti upit. Pokušajte kasnije.",
                        "errorMsgThree" => AppController::QUERY_ERROR_MESSAGE
                    ];
                    DatabaseModel::queryExec($execDataInsert);
            } 
        } catch (Exception $e) {
                AppController::createMessage($e->getMessage(), "page=register");
            }
        }
        AppController::createMessage("Uspešno ste se registrovali!", "page=logIn");
    }
}
?> 