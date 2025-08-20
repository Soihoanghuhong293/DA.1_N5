<?php
class SanPham{
   public $conn; // khai báo phương thức

   public function __construct()
   {
      $this->conn = connectDB(); // gọi hàm kết nối CSDL
   }

   // viết hàm lấy toàn bộ danh sách sản phẩm
   public function getAllProduct(){
      try {
        $spl = "SELECT * FROM san_phams WHERE trang_thai = 1 ORDER BY id DESC";

        $stmt = $this->conn->prepare($spl);

        $stmt->execute();

        return $stmt->fetchAll(); // trả về toàn bộ dữ liệu
      } catch (Exception $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
      }
   }

   public function getProductById($id){
      try {
        $sql = "SELECT sp.*, dm.ten_danh_muc FROM san_phams sp INNER JOIN danh_mucs dm ON sp.danh_muc_id = dm.id WHERE sp.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
      } catch (Exception $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
      }
   }

   public function getProductsByCategory($categoryId){
      try {
        $sql = "SELECT * FROM san_phams WHERE trang_thai = 1 AND danh_muc_id = :cid ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cid' => $categoryId]);
        return $stmt->fetchAll();
      } catch (Exception $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
      }
   }

   public function getLatestProducts($limit = 8){
      try {
        $limit = (int)$limit;
        $sql = "SELECT * FROM san_phams WHERE trang_thai = 1 ORDER BY id DESC LIMIT $limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (Exception $e) {
        echo "Lỗi truy vấn: " . $e->getMessage();
      }
   }
}