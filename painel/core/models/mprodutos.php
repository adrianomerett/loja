<?php
require_once DATABASE;

class Mprodutos
{
    private $table = 'produtos';

    // Cadastra um produto
    public function insertProduct($dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "INSERT INTO {$this->table} (nome, descricao, informacoes, idcategoria, idsubcategoria, estoque, valorcusto, valoroferta, valorvenda, exibirpreco, status) 
            VALUES (:nome, :descricao, :informacoes, :idcategoria, :idsubcategoria, :estoque, :valorcusto, :valoroferta, :valorvenda, :exibirpreco, :status)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':informacoes', $dados['informacoes']);
            $stmt->bindParam(':idcategoria', $dados['idcategoria']);
            $stmt->bindParam(':idsubcategoria', $dados['idsubcategoria']);
            $stmt->bindParam(':estoque', $dados['estoque']);
            $stmt->bindParam(':valorcusto', $dados['valorcusto']);
            $stmt->bindParam(':valoroferta', $dados['valoroferta']);
            $stmt->bindParam(':valorvenda', $dados['valorvenda']);
            $stmt->bindParam(':exibirpreco', $dados['exibirpreco']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pegar o último id do produto
    public function getLastId()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT MAX(produtoid) AS id FROM {$this->table}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row->id;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pegar todos os produtos
    public function getProducts($search, $por_pagina, $offset)
    {
        try {
            $where = !empty($search) ? " AND p.nome LIKE :nome" : "";
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT p.produtoid, p.idcategoria, p.idsubcategoria, p.nome, p.estoque, p.valorcusto, p.valorvenda, p.valoroferta, p.status, 
            c.categoriaid, c.namecategoria, s.subcategoriaid, s.namesubcategoria, 
            i.imgid, i.idproduto, i.img FROM produtos AS p 
            LEFT JOIN categorias AS c ON(C.categoriaid = p.idcategoria) 
            LEFT JOIN subcategorias AS s ON(S.subcategoriaid = p.idsubcategoria)
            INNER JOIN img AS i ON (i.idproduto = p.produtoid) 
            WHERE i.imgid = (SELECT MIN(i2.imgid) FROM img AS i2 WHERE i2.idproduto = p.produtoid){$where} LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($query);
            if (!empty($search)) {
                $stmt->bindValue(':nome', "%{$search}%", PDO::PARAM_STR);
            }
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $rows;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Contar produtos
    public function countProducts($search)
    {
        try {
            $where = !empty($search) ? " WHERE nome LIKE :nome" : "";
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM {$this->table}{$where}";
            $stmt = $conn->prepare($query);
            if (!empty($search)) {
                $stmt->bindValue(':nome', "%{$search}%", PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pegar todos os dados do produto pelo id
    public function getProductById($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE produtoid = :produtoid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':produtoid', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Upade de produto
    public function updateProduct($dados, $id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "UPDATE {$this->table} SET nome = :nome, descricao = :descricao, informacoes = :informacoes, idcategoria = :idcategoria, 
            idsubcategoria = :idsubcategoria, estoque = :estoque, valorcusto = :valorcusto, valoroferta = :valoroferta, valorvenda = :valorvenda, 
            exibirpreco = :exibirpreco, status = :status WHERE produtoid = :produtoid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':descricao', $dados['descricao']);
            $stmt->bindParam(':informacoes', $dados['informacoes']);
            $stmt->bindParam(':idcategoria', $dados['idcategoria']);
            $stmt->bindParam(':idsubcategoria', $dados['idsubcategoria']);
            $stmt->bindParam(':estoque', $dados['estoque']);
            $stmt->bindParam(':valorcusto', $dados['valorcusto']);
            $stmt->bindParam(':valoroferta', $dados['valoroferta']);
            $stmt->bindParam(':valorvenda', $dados['valorvenda']);
            $stmt->bindParam(':exibirpreco', $dados['exibirpreco']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->bindParam(':produtoid', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Delete produto
    public function deleteProduct($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "DELETE FROM {$this->table} WHERE produtoid = :produtoid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':produtoid', $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
