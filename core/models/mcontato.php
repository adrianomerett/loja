<?php
require_once DATABASE;

class Contato extends Database
{

    private $table = 'contatos';

    // Inserir contato
    public function insertContato($dados)
    {
        try {
            $conn = $this->getConnection();
            $sql = "INSERT INTO {$this->table} (nome, email, telefone, assunto, msg, status) 
            VALUES (:nome, :email, :fone, :assunto, :msg, :status)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':fone', $dados['fone']);
            $stmt->bindParam(':assunto', $dados['assunto']);
            $stmt->bindParam(':msg', $dados['mensagem']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
