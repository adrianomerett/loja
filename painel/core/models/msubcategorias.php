<?php
require_once DATABASE;

class Msubcategorias
{
    private $table = 'subcategorias';

    // Busca as categorias
    public function getAllSubCategories($id)
    {
        try {
            $where = $id !== null ? " WHERE idcategoria = :idcategoria" : "";
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table}{$where}";
            $stmt = $conn->prepare($query);
            if ($id !== null) {
                $stmt->bindParam(':idcategoria', $id);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega as sub categorias por nome
    public function getSubCategoriesByName($name)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE namesubcategoria = :namesubcategoria";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':namesubcategoria', $name);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
