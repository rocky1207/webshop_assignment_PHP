<?php
require_once __DIR__ . '/../models/DatabaseModel.php';
class AppController {
    public const EMAIL_REGEX = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    public const PASSWORD_REGEX = "/^(?=\p{Lu})(?=.*\d)[\p{L}\d!]{4,}$/u";
    public const NUMBER_REGEX = "/^\d+$/";
    public const TEXT_REGEX = "/^[\p{L}]+$/u";
    public const DESCRIPTION_REGEX = "/^.+$/";
    public const IMAGE_REGEX = "/^.+\.(jpg|jpeg|png|gif|bmp|webp)$/i";

    public const EMAIL_ERROR_MESSAGE = 'Email nije ispravan.';
    public const PASSWORD_ERROR_MESSAGE = 'Lozinka počinje velikim slovom, sadrži najmanje jednu cifru, dozvoljava slova i znak !, i ima minimalnu dužinu od 4 karaktera.';
    public const WRONG_PASSWORD_MESSAGE = 'Pogrešna lozinka.';
    public const QUERY_ERROR_MESSAGE =  'Greška prilikom izvršenja upita';
    public const NO_PRODUCTS_MESSAGE =  'Nema rezultata za navedeni upit';
    public const EMAIL_EXISTS_MESSAGE =  'Email već postoji. Unesite drugi.';

    public const TEXT_ERROR_MESSAGE =  'Naziv mora biti popunjen samo slovnim karakterima.';
    public const DESCRIPTION_ERROR_MESSAGE =  'Polje opisa proizvoda mora biti popunjeno.';
    public const IMAGE_ERROR_MESSAGE =  'Slika mora na kraju imati ekstenziju, npr. .jpg ili .png...';
    public const NUMBER_ERROR_MESSAGE =  'Cena i količina mogu biti popunjene samo brojevima.';

    public static function databaseConnect() {
        try {
            DatabaseModel::connect();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public static function createMessage($message, $page) {
        $_SESSION['message'] = $message;
        Header("Location: ?{$page}", true, 303);
        exit();
    }
    public static function validateInputs($inputs, $regex, $messages, $page) {
        $data = [];
         foreach($inputs as $key => $input) {
            ${$key} = isset($input) ? trim($input) : '';
            !preg_match($regex[$key], ${$key}) && self::createMessage($messages[$key], $page);
            $data[$key] = ${$key};
        }
         return $data;
    }

    public static function isPasswordEqual($data) {
        $data["password"] !== $data["confirmPassword"] && self::createMessage("Lozinka i njena potvrda moraju biti identične", "page=register");
        $data["password"] === $data["confirmPassword"] && $newData = ["email" => $data["email"], "password" => $data["password"]];
        return $newData;
    }
}

?>