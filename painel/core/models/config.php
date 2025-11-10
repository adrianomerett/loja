<?php
require_once DATABASE;

class Config
{
    private $table = 'config';

    // Pega os dados de configuração do sistema
    public static function getConfig()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM config";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ)[0];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Salva as configurações do sistema
    public function updateConfig($dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "UPDATE config SET nameloja = :nameloja, slogan = :slogan, version = :version, 
            email = :email, fone = :fone, celular = :celular, cidade = :cidade, bairro = :bairro, rua = :rua, 
            numero = :numero, instagran = :instagran, facebook = :facebook, x = :x, 
            exibir_estoque = :exibir_estoque, exibir_preco = :exibir_preco, exibir_produto_sem_estoque = :exibir_produto_sem_estoque, 
            exibir_compartilhar = :exibir_compartilhar WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->execute($dados);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
