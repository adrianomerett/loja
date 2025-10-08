<?php
require_once DATABASE;

class Mcategorias
{
    private $table = 'categorias';

    // Busca as categorias
    public function getAllCategories($id)
    {
        try {
            $where = $id !== null ? " WHERE categoriaid = :categoriaid" : "";
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table}{$where} ORDER BY namecategoria ASC";
            $stmt = $conn->prepare($query);
            if ($id !== null) {
                $stmt->bindParam(':categoriaid', $id);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Busca as categorias
    public function getCategories($por_pagina, $offset)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} ORDER BY namecategoria ASC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Cadastra uma categoria
    public function insertCategory($dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "INSERT INTO {$this->table} (namecategoria) VALUES (:namecategoria)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':namecategoria', $dados['namecategoria']);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Edita uma categoria
    public function updateCategory($id, $dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "UPDATE {$this->table} SET namecategoria = :namecategoria WHERE categoriaid = :categoriaid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':namecategoria', $dados['namecategoria']);
            $stmt->bindParam(':categoriaid', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Get categoria por nome
    public function getCategoryByName($name)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE namecategoria = :namecategoria";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':namecategoria', $name);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Contar categorias
    public function countCategories()
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

    // Excluir categoria
    public function deleteCategory($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "DELETE FROM {$this->table} WHERE categoriaid = :categoriaid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':categoriaid', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
