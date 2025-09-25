<?php
require_once DATABASE;

class Musers
{
    private $table = 'users';

    // Busca o usuário para login
    public function getUserLogin($email)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT name, sobrenome, email, password, userid, status, level FROM {$this->table} WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Salva usuário
    public function saveUser($dados)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "INSERT INTO {$this->table} (name, sobrenome, email, password, status, level) VALUES (:name, :sobrenome, :email, :password, :status, :level)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $dados['name']);
            $stmt->bindParam(':sobrenome', $dados['sobrenome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':password', $dados['password']);
            $stmt->bindParam(':status', $dados['status']);
            $stmt->bindParam(':level', $dados['level']);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Buscar usuário
    public function getAllUser()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT userid, name, sobrenome, email, status, level, cadastrado FROM {$this->table}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Deletar usuário
    public function deleteUser($userid)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "DELETE FROM {$this->table} WHERE userid = :userid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userid', $userid);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
