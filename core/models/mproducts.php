<?php
require_once DATABASE;

class Produtos extends Database
{
    public $table = 'produtos';

    // Buscar produtos recente pagina inicial
    public function getProductsRecentes()
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' ORDER BY p.produtoid DESC LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega produtos com desconto acima de 10%
    public function getProductsOffDescont()
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' 
            AND ((p.valorvenda - p.valoroferta) / p.valorvenda) * 100 >= 9.09 ORDER BY p.produtoid DESC LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Tem tudo a ver com você
    public function getProductYouLike()
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' ORDER BY p.produtoid ASC LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
