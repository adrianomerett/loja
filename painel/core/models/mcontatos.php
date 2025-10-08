<?php
require_once DATABASE;

class Mcontatos
{
    private $table = 'contatos';

    // Conta o tatal de contatos recebidos
    public function countContacts()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM {$this->table}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Conta os contatos pendentes 
    public function countContactsPending()
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status = 'P'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}