<?php
require_once __DIR__ . '/../models/DatabaseModel.php';
class AppController {
    public const EMAIL_REGEX = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    public const PASSWORD_REGEX = "/^(?=\p{Lu})(?=.*\d)[\p{L}\d!]{4,}$/u";
    public const EMAIL_ERROR_MESSAGE = 'Email nije ispravan.';
    public const PASSWORD_ERROR_MESSAGE = 'Lozinka počinje velikim slovom, sadrži najmanje jednu cifru, dozvoljava slova i znak !, i ima minimalnu dužinu od 4 karaktera.';
    public const WRONG_PASSWORD_MESSAGE = 'Pogrešna lozinka.';
    public const QUERY_ERROR_MESSAGE =  'Greška prilikom izvršenja upita';
    public const NO_PRODUCTS_MESSAGE =  'Nema rezultata za navedeni upit';

    public static function databaseConnect() {
        try {
            DatabaseModel::connect();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function createMessage($errorMsg, $page) {
        $_SESSION['errorMsg'] = $errorMsg;
        Header("Location: ?{$page}", true, 303);
        exit();
    }
    public static function validateInputs($inputs, $regex, $messages) {
        $data = [];
        foreach($inputs as $key => $input) {
            ${$key} = isset($input) ? trim($input) : '';
            !preg_match($regex[$key], ${$key}) && self::createMessage($messages[$key], "page=home");
            $data[$key] = ${$key};
        }
        
        return $data;
    }
}

?>