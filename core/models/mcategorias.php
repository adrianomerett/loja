<?php
require_once DATABASE;

class Categorias extends Database
{

    private $table = 'categorias';

    public function getCategorias()
    {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM {$this->table} ORDER BY namecategoria ASC";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Listar produtos de uma categoria
    public function getProductsByCategoria($idcategoria, $por_pagina, $offset)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM produtos AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) 
            AND p.idcategoria = :idcategoria AND p.status = 'A' ORDER BY p.produtoid DESC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idcategoria', $idcategoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Contar produtos por categoria
    public function countProductsGetByCategoria($categoriaid)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM produtos WHERE idcategoria = :idcategoria AND status = 'A'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idcategoria', $categoriaid);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega o nome da categoria pelo id
    public function getNameCategoryById($idcategoria)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT namecategoria FROM {$this->table} WHERE categoriaid = :categoriaid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':categoriaid', $idcategoria);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (count($dados) > 0) {
                return $dados[0]->namecategoria;
            }
            return false;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
