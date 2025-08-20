<?php

class TaiKhoan
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function findByEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email LIMIT 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi truy vấn: ' . $e->getMessage();
        }
    }

    public function checkEmailExists($email)
    {
        $user = $this->findByEmail($email);
        return !empty($user);
    }

    public function create($data)
    {
        try {
            $sql = 'INSERT INTO tai_khoans (ho_ten, email, mat_khau, so_dien_thoai, chuc_vu_id, trang_thai) VALUES (:ho_ten, :email, :mat_khau, :so_dien_thoai, :chuc_vu_id, :trang_thai)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $data['ho_ten'],
                ':email' => $data['email'],
                ':mat_khau' => $data['mat_khau'],
                ':so_dien_thoai' => $data['so_dien_thoai'] ?? null,
                ':chuc_vu_id' => $data['chuc_vu_id'] ?? null,
                ':trang_thai' => $data['trang_thai'] ?? 1,
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo 'Lỗi truy vấn: ' . $e->getMessage();
        }
    }
} 