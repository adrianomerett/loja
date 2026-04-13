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
            $sql = "SELECT email FROM {$this->table} WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    // Pegar a senha do cliente
    public function getPassword($email)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT password FROM {$this->table} WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pegar dados do cliente pelo email
    public function getDataClinet($email)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT clienteid, nome, email, status FROM {$this->table} WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Pegar email e senha do cliente para login
    public function getEmailSenha($email)
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT email, password FROM {$this->table} WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
