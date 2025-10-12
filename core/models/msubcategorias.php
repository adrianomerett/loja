<?php
require_once DATABASE;

class Subcategorias extends Database
{
    private $table = 'subcategorias';

    public function getSubcategoriasByIdCategoria($idcate){
        try{
            $conn = $this->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE idcategoria = :idcategoria ORDER BY namesubcategoria ASC";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idcategoria', $idcate);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

}