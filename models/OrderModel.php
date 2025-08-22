<?php
class OrderModel {
    private $db;

    public function __construct() {
        // sửa lại dbname, user, pass cho đúng
        $this->db = new PDO("mysql:host=localhost;dbname=your_db;charset=utf8", "root", "");
    }

    public function createCOD($ten,$email,$sdt,$diachi,$ghichu,$items,$tong) {
        $sql = "INSERT INTO don_hang (ten_nguoi_nhan,email,sdt,dia_chi,ghi_chu,tong_tien,trang_thai,phuong_thuc) 
                VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$ten,$email,$sdt,$diachi,$ghichu,$tong,'Chưa thanh toán','COD']);
        $orderId = $this->db->lastInsertId();

        foreach ($items as $it) {
            $sql2 = "INSERT INTO don_hang_chi_tiet (don_hang_id,san_pham_id,so_luong,don_gia) VALUES (?,?,?,?)";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->execute([$orderId,$it['sp']['id'],$it['so_luong'],$it['don_gia']]);
        }
        return $orderId;
    }
}
