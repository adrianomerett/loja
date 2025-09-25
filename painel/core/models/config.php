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
}
