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

    // Busca os contatos 
    public function getContacts($por_pagina, $offset)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} ORDER BY contatoid DESC LIMIT {$por_pagina} OFFSET {$offset}";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $rows;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Conta os contatos
    public function countAllContacts()
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

    // Pega um contato específico
    public function getContactDetails($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table} WHERE contatoid = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Update no status
    public function updateStatus($id, $status)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "UPDATE {$this->table} SET status = :status WHERE contatoid = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Delete contact
    public function deleteContact($id)
    {
        try {
            $db = new Database();
            $conn = $db->getConnection();
            $query = "DELETE FROM {$this->table} WHERE contatoid = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
