<?php
require_once(__DIR__ . '/Database.php');
class DatabaseModel {
    public static PDO $pdo;
    
    public static function connect() {
        try {
            $db = new Database('localhost', 'web_shop', 'root', '');
            self::$pdo = $db->dbConnection();
        } catch (Exception $e) {
          throw new Exception($e->getMessage());
        }
    }

    public static function queryExec($execData) {
        $params = isset($execData["data"]) ? ["email" => $execData["data"]["email"]] : null;
        try {
            self::$pdo->beginTransaction();
            $stmt = self::$pdo->prepare($execData["query"]);
            $stmt->execute($params);
            if($stmt->rowCount() <= 0) {
                self::$pdo->rollBack();
                throw new Exception($execData["errorMsgOne"]);
            }
            
            if($stmt->rowCount() > 0) {
                self::$pdo->commit();
                $data = $stmt->fetchAll();
                if(isset($user[0]["lozinka"]) && $stmt->rowCount() === 1) {
                    //$passwordVerify = password_verify($execData["data"]["password"], $user['lozinka']);
                    $passwordVerify = $execData["data"]["password"] === $user[0]["lozinka"];
                    !$passwordVerify && throw new Exception($execData["errorMsgTwo"]);
                }
                return $data;
            }
        } catch (PDOException $e) {
           self::$pdo->rollBack();
           throw new Exception("{$execData["errorMsgThree"]}: {$e->getMessage()}");
        }
    }
}
?>