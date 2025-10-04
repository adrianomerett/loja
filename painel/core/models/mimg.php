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
}
