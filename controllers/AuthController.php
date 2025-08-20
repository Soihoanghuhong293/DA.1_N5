<?php

class AuthController
{
    protected $modelTaiKhoan;
    protected $modelDanhMuc;

    public function __construct()
    {
        $this->modelTaiKhoan = new TaiKhoan();
        if (class_exists('DanhMuc')) {
            $this->modelDanhMuc = new DanhMuc();
        }
    }

    public function dangNhap()
    {
        $errors = [];
        $danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            }
            if ($password === '') {
                $errors['password'] = 'Vui lòng nhập mật khẩu';
            }

            if (empty($errors)) {
                $user = $this->modelTaiKhoan->findByEmail($email);
                if (!$user || !password_verify($password, $user['mat_khau'])) {
                    $errors['general'] = 'Email hoặc mật khẩu không đúng';
                } elseif (isset($user['trang_thai']) && (int)$user['trang_thai'] !== 1) {
                    $errors['general'] = 'Tài khoản đã bị khóa';
                } else {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'ho_ten' => $user['ho_ten'] ?? '',
                        'email' => $user['email'],
                        'chuc_vu_id' => $user['chuc_vu_id'] ?? null,
                    ];
                    header('Location: ' . BASE_URL);
                    exit;
                }
            }
        }
        require_once './views/layout/header.php';
        require_once './views/auth/login.php';
        require_once './views/layout/footer.php';
    }

    public function dangKy()
    {
        $errors = [];
        $old = [];
        $danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old['ho_ten'] = trim($_POST['ho_ten'] ?? '');
            $old['email'] = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $old['so_dien_thoai'] = trim($_POST['so_dien_thoai'] ?? '');

            if ($old['ho_ten'] === '') {
                $errors['ho_ten'] = 'Vui lòng nhập họ tên';
            }
            if ($old['email'] === '' || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            }
            if ($password === '' || strlen($password) < 6) {
                $errors['password'] = 'Mật khẩu tối thiểu 6 ký tự';
            }
            if ($confirm !== $password) {
                $errors['confirm_password'] = 'Xác nhận mật khẩu không khớp';
            }
            if (empty($errors) && $this->modelTaiKhoan->checkEmailExists($old['email'])) {
                $errors['email'] = 'Email đã tồn tại';
            }

            if (empty($errors)) {
                $this->modelTaiKhoan->create([
                    'ho_ten' => $old['ho_ten'],
                    'email' => $old['email'],
                    'mat_khau' => password_hash($password, PASSWORD_BCRYPT),
                    'so_dien_thoai' => $old['so_dien_thoai'] ?? null,
                    'chuc_vu_id' => 2,
                    'trang_thai' => 1,
                ]);
                // Auto login
                $_SESSION['user'] = $this->modelTaiKhoan->findByEmail($old['email']);
                header('Location: ' . BASE_URL);
                exit;
            }
        }
        require_once './views/layout/header.php';
        require_once './views/auth/register.php';
        require_once './views/layout/footer.php';
    }

    public function dangXuat()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location: ' . BASE_URL);
        exit;
    }
} 