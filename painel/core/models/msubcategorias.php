<?php
require_once DATABASE;

class Msubcategorias
{
    private $table = 'subcategorias';

    // Cadastra uma categoria
    public function insertSubCategory($dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "INSERT INTO {$this->table} (idcategoria, namesubcategoria) VALUES (:idcategoria, :namesubcategoria)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idcategoria', $dados['idcategoria']);
            $stmt->bindParam(':namesubcategoria', $dados['namesubcategoria']);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Busca as categorias
    public function getAllSubCategories($id)
    {
        try {
            $where = $id !== null ? " WHERE idcategoria = :idcategoria" : "";
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table}{$where} ORDER BY namesubcategoria ASC";
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

    // Contar Sub Categorias
    public function countSubCategories()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM {$this->table}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega uma subacategoria por id da categoria
    public function getSubCategoryByCategoriaId($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE idcategoria = :idcategoria";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idcategoria', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
