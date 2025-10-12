<?php
require_once DATABASE;

class Produtos extends Database
{
    public $table = 'produtos';

    // Buscar produtos recente pagina inicial
    public function getProductsRecentes()
    {
        try {
            $conn = $this->getConnection();
            $sql = "SELECT * FROM  {$this->table} ORDER BY produtoid DESC LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
