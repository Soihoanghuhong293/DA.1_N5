<?php
class AdminTaiKhoan
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan()
    {
        try {
            $sql = "SELECT tai_khoans.*, chuc_vus.ten_chuc_vu 
                    FROM tai_khoans 
                    INNER JOIN chuc_vus ON tai_khoans.chuc_vu_id = chuc_vus.id
                    ORDER BY tai_khoans.id DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function insertTaiKhoan($ho_ten, $anh_dai_dien, $ngay_sinh, $email, $so_dien_thoai, $gioi_tinh, $dia_chi, $mat_khau, $chuc_vu_id)
    {
        try {
            $sql = "INSERT INTO tai_khoans (ho_ten, anh_dai_dien, ngay_sinh, email, so_dien_thoai, gioi_tinh, dia_chi, mat_khau, chuc_vu_id, trang_thai)
                    VALUES (:ho_ten, :anh_dai_dien, :ngay_sinh, :email, :so_dien_thoai, :gioi_tinh, :dia_chi, :mat_khau, :chuc_vu_id, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':anh_dai_dien' => $anh_dai_dien,
                ':ngay_sinh' => $ngay_sinh,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':mat_khau' => password_hash($mat_khau, PASSWORD_DEFAULT),
                ':chuc_vu_id' => $chuc_vu_id
            ]);

            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailTaiKhoan($id)
    {
        try {
            $sql = "SELECT tai_khoans.*, chuc_vus.ten_chuc_vu 
                    FROM tai_khoans 
                    INNER JOIN chuc_vus ON tai_khoans.chuc_vu_id = chuc_vus.id
                    WHERE tai_khoans.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateTaiKhoan($id, $ho_ten, $anh_dai_dien, $ngay_sinh, $email, $so_dien_thoai, $gioi_tinh, $dia_chi, $chuc_vu_id, $mat_khau = null)
    {
        try {
            if ($mat_khau) {
                $sql = "UPDATE tai_khoans 
                        SET ho_ten = :ho_ten, anh_dai_dien = :anh_dai_dien, ngay_sinh = :ngay_sinh, 
                            email = :email, so_dien_thoai = :so_dien_thoai, gioi_tinh = :gioi_tinh, 
                            dia_chi = :dia_chi, chuc_vu_id = :chuc_vu_id, mat_khau = :mat_khau
                        WHERE id = :id";
                $params = [
                    ':ho_ten' => $ho_ten,
                    ':anh_dai_dien' => $anh_dai_dien,
                    ':ngay_sinh' => $ngay_sinh,
                    ':email' => $email,
                    ':so_dien_thoai' => $so_dien_thoai,
                    ':gioi_tinh' => $gioi_tinh,
                    ':dia_chi' => $dia_chi,
                    ':chuc_vu_id' => $chuc_vu_id,
                    ':mat_khau' => password_hash($mat_khau, PASSWORD_DEFAULT),
                    ':id' => $id
                ];
            } else {
                $sql = "UPDATE tai_khoans 
                        SET ho_ten = :ho_ten, anh_dai_dien = :anh_dai_dien, ngay_sinh = :ngay_sinh, 
                            email = :email, so_dien_thoai = :so_dien_thoai, gioi_tinh = :gioi_tinh, 
                            dia_chi = :dia_chi, chuc_vu_id = :chuc_vu_id
                        WHERE id = :id";
                $params = [
                    ':ho_ten' => $ho_ten,
                    ':anh_dai_dien' => $anh_dai_dien,
                    ':ngay_sinh' => $ngay_sinh,
                    ':email' => $email,
                    ':so_dien_thoai' => $so_dien_thoai,
                    ':gioi_tinh' => $gioi_tinh,
                    ':dia_chi' => $dia_chi,
                    ':chuc_vu_id' => $chuc_vu_id,
                    ':id' => $id
                ];
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function destroyTaiKhoan($id)
    {
        try {
            $sql = "DELETE FROM tai_khoans WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function toggleTrangThai($id)
    {
        try {
            $sql = "UPDATE tai_khoans SET trang_thai = NOT trang_thai WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function checkEmailExists($email, $exclude_id = null)
    {
        try {
            if ($exclude_id) {
                $sql = "SELECT COUNT(*) as count FROM tai_khoans WHERE email = :email AND id != :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':email' => $email, ':id' => $exclude_id]);
            } else {
                $sql = "SELECT COUNT(*) as count FROM tai_khoans WHERE email = :email";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':email' => $email]);
            }

            $result = $stmt->fetch();
            return $result['count'] > 0;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
?> 