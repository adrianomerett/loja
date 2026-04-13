<?php
require_once DATABASE;

class Produtos extends Database
{
    public $table = 'produtos';
    public $tablefovoritos = 'favoritos';

    // Buscar produtos recente pagina inicial
    public function getProductsRecentes()
    {
        try {
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND p.estoque > 0';
            }
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' {$whereestoque} ORDER BY p.produtoid DESC LIMIT 12";
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
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND p.estoque > 0';
            }
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' {$whereestoque} 
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
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND p.estoque > 0';
            }
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' {$whereestoque} ORDER BY p.produtoid ASC LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Buscar produtos recente pagina inicial
    public function getAllProducts($por_pagina, $offset)
    {
        try {
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND p.estoque > 0';
            }
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' {$whereestoque} ORDER BY p.produtoid ASC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Conta todos os produtos
    public function countProductsAll()
    {
        try {
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND estoque > 0';
            }
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status = 'A' {$whereestoque}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega os dados do produto pelo id 
    public function getProductById($id)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.descricao, p.informacoes, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.produtoid = :produtoid AND p.status = 'A'";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':produtoid', $id);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (count($dados) <= 0) {
                return false;
            }
            return $dados[0];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega os produtos relacionados a uma categoria
    public function getProductsRellByCategory($idproduct, $idcategoria, $por_pagina, $offset)
    {
        try {
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND p.estoque > 0';
            }
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM produtos AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) 
            AND p.idcategoria = :idcategoria AND p.produtoid != :produtoid 
            AND p.status = 'A' {$whereestoque} ORDER BY p.produtoid DESC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':produtoid', $idproduct);
            $stmt->bindParam(':idcategoria', $idcategoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Contar produtos pela busca 
    public function countProductsSearch($busca)
    {
        try {
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND estoque > 0';
            }
            $like = '%' . $busca . '%';
            $conn = $this->getConnection();
            $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status = 'A' {$whereestoque} AND nome LIKE :nome";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $like);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pega os produtos pela busca 
    public function getProductsBySearch($busca, $por_pagina, $offset)
    {
        try {
            $whereestoque = '';
            if ($this->epse == 'N') {
                $whereestoque = ' AND p.estoque > 0';
            }
            $like = '%' . $busca . '%';
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
            p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
            i.img FROM  {$this->table} AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
            ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid) AND p.status = 'A' {$whereestoque} 
            AND p.nome LIKE :nome ORDER BY p.produtoid ASC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $like);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Buscar produtos favoritos
    public function getFavoritos($idcliente){
        try{
            $conn = $this->getConnection();
            $sql = "SELECT p.produtoid, p.nome, p.idcategoria, p.idsubcategoria, p.estoque, p.valorvenda, p.valoroferta, 
                    p.exibirpreco, p.status, c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, i.imgid, i.idproduto, 
                    i.img, f.clientid, f.productid FROM produtos AS p LEFT JOIN categorias AS c ON(c.categoriaid = p.idcategoria) LEFT JOIN subcategorias AS s 
                    ON(s.subcategoriaid = p.idsubcategoria) INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
                    INNER JOIN favoritos AS f ON (f.productid = p.produtoid)
                    WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid)
                    AND f.clientid = :clientid ORDER BY p.produtoid DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clientid', $idcliente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
