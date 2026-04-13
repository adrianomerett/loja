<?php
require_once DATABASE;

class Favoritos extends Database
{
    // Tabela
    public $table = 'favoritos';

    // Adicionar favorito
    public function addFavorite($idcliente, $productid)
    {
        try {
            $conn = $this->getConnection();
            $sql = "INSERT INTO {$this->table} (clientid, productid) VALUES (:clientid, :productid)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clientid', $idcliente);
            $stmt->bindParam(':productid', $productid);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // buscar favoritos pelo cliente
    public function getFavoritosByClient($idcliente)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT productid FROM {$this->table} WHERE clientid = :clientid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clientid', $idcliente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Verifica se o produto já está no favoritos
    public function isFavorite($idcliente, $productid)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT productid FROM {$this->table} WHERE clientid = :clientid AND productid = :productid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clientid', $idcliente);
            $stmt->bindParam(':productid', $productid);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Remover favorito
    public function removeFavorite($idcliente, $productid)
    {
        try {
            $conn = $this->getConnection();
            $sql = "DELETE FROM {$this->table} WHERE clientid = :clientid AND productid = :productid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clientid', $idcliente);
            $stmt->bindParam(':productid', $productid);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
