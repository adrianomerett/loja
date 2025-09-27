<?php
require_once DATABASE;

class Mcategorias
{
    private $table = 'categorias';

    // Busca as categorias
    public function getAllCategories($id)
    {
        try {
            $where = $id !== null ? " WHERE categoriaid = :categoriaid" : "";
            $db = new Database();
            $conn = $db->getConnection();
            $query = "SELECT * FROM {$this->table}{$where}";
            $stmt = $conn->prepare($query);
            if ($id !== null) {
                $stmt->bindParam(':categoriaid', $id);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
