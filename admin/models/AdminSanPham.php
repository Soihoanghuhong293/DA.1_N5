<?php
class AdminSanPham
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối đến cơ sở dữ liệu
    }

    public function getAllSanPham()
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams 
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            $sql = "INSERT INTO san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
            VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh
            ]);

            return $this->conn->lastInsertId(); // Trả về ID của sản phẩm vừa thêm;  
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh)
    {
        try {
            $sql = 'INSERT INTO album_anh_san_pham (id_san_pham, duong_dan_anh)
            VALUES (:san_pham_id, :link_hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh
            ]);

            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM san_phams WHERE id= :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM album_anh_san_pham WHERE id_san_pham = :id ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh)
    {
        try {
            $sql = 'UPDATE san_phams
            SET ten_san_pham = :ten_san_pham, 
                gia_san_pham = :gia_san_pham, 
                gia_khuyen_mai = :gia_khuyen_mai, 
                so_luong = :so_luong, 
                ngay_nhap = :ngay_nhap, 
                danh_muc_id = :danh_muc_id, 
                trang_thai = :trang_thai, 
                mo_ta = :mo_ta,
                hinh_anh = :hinh_anh
            WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id
            ]);

            return true; // Trả về ID của sản phẩm vừa thêm;  
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function getDetailAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM album_anh_san_pham WHERE id= :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function updateAnhSanPham($id, $new_file)
    {
        try {
            $sql = 'UPDATE album_anh_san_pham
            SET 
                duong_dan_anh = :new_file    
            WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':new_file' => $new_file,
                ':id' => $id
            ]);

            return true; // Trả về ID của sản phẩm vừa thêm;  
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function destroyAnhSanPham($id)
    {
        try {
            $sql = 'DELETE FROM album_anh_san_pham WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
            ]);

            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


     public function destroySanPham($id){
        try {
            $sql = 'DELETE FROM san_phams WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    // binh luah
  //  public function getBinhLuanFromKhachHang($id)
}
