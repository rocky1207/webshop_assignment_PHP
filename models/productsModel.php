<?php
require_once(__DIR__ . '/../models/base.php');

class ProductsModel {
    private $db;
    private $pdo;
    function conenct() {
        try {
            $this->db = new Database('localhost', 'web_shop', 'root', '');
            $this->pdo = $this->db->dbConnection();
        } catch (Exception $e) {
           return $this->getErrorMessage($e->getMessage());
        }
    }
    
    function getAllProducts() {
        $query = "SELECT * FROM proizvodi";
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            if($stmt->rowCount() <= 0) {
                $this->pdo->rollBack();
                return $this->getErrorMessage('Nema rezultata za navedeni upit');
            }
            $this->pdo->commit();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
           return $this->getErrorMessage("Greška prilikom izvršenja upita: {$e->getMessage()}");
        }
    }
    
    
   
    function getErrorMessage($msg) {
        return $msg;
   }
}

?>