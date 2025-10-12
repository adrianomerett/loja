<?php
require_once DATABASE;

class Categorias extends Database
{

    public function getCategorias()
    {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM categorias ORDER BY namecategoria ASC";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
