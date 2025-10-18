<?php
require_once DATABASE;

class Imagens extends Database
{

    private $table = 'img';

    // Pega as imgens pelo id produto
    public function getImgByIdProduct($idproduto)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM {$this->table} WHERE idproduto = :idproduto";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idproduto', $idproduto);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}