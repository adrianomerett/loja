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

    // Listar produtos de uma categoria
     public function getProductsBtCategoria($idcategoria)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM produtos AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) 
            AND p.idcategoria = :idcategoria AND p.status = 'A' ORDER BY p.produtoid DESC LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idcategoria', $idcategoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
