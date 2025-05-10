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
        $queryType = strtoupper(strtok(trim($execData["query"])," "));
        $key = $execData["data"]["key"] ?? "";
        $checkType = $execData["checkType"] ?? '';
        if(isset($execData["data"]) && $queryType === "SELECT") {
            $params =  [$key => $execData["data"][$key]] ?? null;
        } else {
            $params = $execData["data"] ?? [];
        }
        
        try {
            self::$pdo->beginTransaction();
            $stmt =  self::$pdo->prepare($execData["query"]);
            $stmt->execute($params);
            switch($queryType) {
                
                case "SELECT":
                    $data = $stmt->fetchAll();
                    if ($checkType === "emailExist") {
                        if(empty($data)) {
                            self::$pdo->commit();
                            return $data;
                        }
                        if(count($data) > 0) {
                            self::$pdo->rollBack();
                            throw new Exception($execData["errorMsgOne"]);
                        }
                    }  
                    if(empty($data)) {
                        self::$pdo->rollBack();
                        throw new Exception($execData["errorMsgOne"]);
                    }
                    if(count($data) > 0) {
                        if(isset($data[0]["lozinka"]) && count($data) === 1) {
                            $passwordVerify = password_verify($execData["data"]["password"], $data[0]["lozinka"]);
                            !$passwordVerify && throw new Exception($execData["errorMsgTwo"]);
                        }
                        self::$pdo->commit();
                        return $data;
                    }
                    break;
                case "INSERT":
                    if($stmt->rowCount() === 0) {
                        self::$pdo->rollBack();
                        throw new Exception($execData["errorMsgOne"]);
                    }
                    $lastId = self::$pdo->lastInsertId();
                    self::$pdo->commit();
                    return ["lastInsertId" => $lastId];
                    break;
                case "UPDATE":
                case "DELETE":
                    if($stmt->rowCount() === 0) {
                        self::$pdo->rollBack();
                        throw new Exception($execData["errorMsgOne"]);
                    }
                    self::$pdo->commit();
                    return ["deletedItems" => $stmt->rowCount()];
                    break;
                default:
                    self::$pdo->rollBack();
                    throw new Exception("Nepodržana vrsta upita: {$queryType}");
            }
        } catch(PDOException $e) {
            self::$pdo->rollBack();
           throw new Exception("{$execData["errorMsgThree"]}: {$e->getMessage()}");
        }
    }
}
?>