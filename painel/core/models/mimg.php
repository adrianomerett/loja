<?php
require_once DATABASE;

class Mimg
{
    private $table = 'img';

    // Cadastra uma foto
    public function insertImage($dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "INSERT INTO {$this->table} (idproduto, img) VALUES (:idproduto, :img)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idproduto', $dados['idproduto']);
            $stmt->bindParam(':img', $dados['img']);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega as imagens de um produto
    public function getImages($idproduto)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE idproduto = :idproduto";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idproduto', $idproduto);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Deleta uma foto
    public function deleteImage($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "DELETE FROM {$this->table} WHERE imgid = :imgid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imgid', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega um imagem pelo id da foto
    public function getImageById($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE imgid = :imgid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':imgid', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
