<?php
class AdminChucVu
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllChucVu()
    {
        try {
            $sql = "SELECT * FROM chuc_vus ORDER BY id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailChucVu($id)
    {
        try {
            $sql = "SELECT * FROM chuc_vus WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
?> 