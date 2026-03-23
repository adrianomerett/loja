<?php
require_once DATABASE;

class Clientes extends Database
{

    private $table = 'clientes';

    // Inserir cliente
    public function insertCliente($dados)
    {
        try {
            $conn = $this->getConnection();
            $sql = "INSERT INTO {$this->table} (nome, email, password, status) 
            VALUES (:nome, :email, :password, :status)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':password', $dados['password']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Buscar o último id
    public function getLastId()
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT MAX(clienteid) AS clienteid FROM {$this->table}";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['clienteid'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Verificar se o cliente já existe
    public function checkCliente($email)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT COUNT(*) AS count FROM {$this->table} WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['count'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
