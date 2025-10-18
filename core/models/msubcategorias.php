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

    // Pega o nome da subcategoria pelo id
    public function getNameCategoryById($idsubcategoria)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT namesubcategoria FROM {$this->table} WHERE subcategoriaid = :subcategoriaid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':subcategoriaid', $idsubcategoria);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (count($dados) > 0) {
                return $dados[0]->namesubcategoria;
            }
            return false;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Listar produtos de uma categoria
    public function getProductsBySubCategoria($idsubcategoria, $por_pagina, $offset)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM produtos AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) 
            AND p.idsubcategoria = :idsubcategoria AND p.status = 'A' ORDER BY p.produtoid ASC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idsubcategoria', $idsubcategoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Contar produtos por categoria
    public function countProductsGetBySubCategoria($subcategoriaid)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM produtos WHERE idsubcategoria = :idsubcategoria AND status = 'A'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idsubcategoria', $subcategoriaid);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}