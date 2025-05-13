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
        $keys = $execData["keys"] ?? [];
        $_SESSION["keys"] = $keys;
        $checkType = $execData["checkType"] ?? '';
        if(isset($execData["data"]) && $queryType === "SELECT") {
            foreach ($keys as $key) {
                $params[$key] = $execData["data"][$key];
            }
        } else {
            $params = $execData["data"] ?? [];
        }
        $_SESSION["params"] = $params ?? null;
        try {
            self::$pdo->beginTransaction();
            $stmt =  self::$pdo->prepare($execData["query"]);
            
            $stmt->execute($params);
            switch($queryType) {
                
                case "SELECT":
                    $datas = $stmt->fetchAll();
                    if ($checkType === "emailExist") {
                        if(empty($datas)) {
                            self::$pdo->commit();
                            return $datas;
                        }
                        if(count($datas) > 0) {
                            self::$pdo->rollBack();
                            throw new Exception($execData["errorMsgOne"]);
                        }
                    }  
                    if(empty($datas)) {
                        self::$pdo->rollBack();
                        throw new Exception($execData["errorMsgOne"]);
                    }
                    if(count($datas) > 0) {
                        if(isset($datas[0]["lozinka"]) && count($datas) === 1) {
                            $passwordVerify = password_verify($execData["data"]["password"], $datas[0]["lozinka"]);
                            !$passwordVerify && throw new Exception($execData["errorMsgTwo"]);
                        }
                        self::$pdo->commit();
                        $result = [];

                        foreach ($datas as $data) {
                            $item = [];
                            foreach ($data as $key => $value) {
                                $item[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                            }
                            $result[] = $item;
                        }
                        return $result;
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
