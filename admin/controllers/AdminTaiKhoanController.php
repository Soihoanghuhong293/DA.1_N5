<?php
class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelChucVu;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelChucVu = new AdminChucVu();
    }

    public function danhSachTaiKhoan()
    {
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoan();
        require_once './views/taikhoan/listTaiKhoan.php';
    }

    public function formAddTaiKhoan()
    {
        $listChucVu = $this->modelChucVu->getAllChucVu();
        require_once './views/taikhoan/addTaiKhoan.php';
        deleteSessionError();
    }

    public function postAddTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? 1;
            $dia_chi = $_POST['dia_chi'] ?? '';
            $mat_khau = $_POST['mat_khau'] ?? '';
            $chuc_vu_id = $_POST['chuc_vu_id'] ?? '';

            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            $file_thumb = null;

            if ($anh_dai_dien && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {
                $file_thumb = uploadFile($anh_dai_dien, './uploads/');
            }

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }

            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            } elseif ($this->modelTaiKhoan->checkEmailExists($email)) {
                $errors['email'] = 'Email đã tồn tại';
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }

            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Mật khẩu không được để trống';
            } elseif (strlen($mat_khau) < 6) {
                $errors['mat_khau'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            if (empty($chuc_vu_id)) {
                $errors['chuc_vu_id'] = 'Chức vụ phải được chọn';
            }

            $_SESSION['error'] = $errors;

            if (empty($errors)) {
                $this->modelTaiKhoan->insertTaiKhoan(
                    $ho_ten,
                    $file_thumb,
                    $ngay_sinh,
                    $email,
                    $so_dien_thoai,
                    $gioi_tinh,
                    $dia_chi,
                    $mat_khau,
                    $chuc_vu_id
                );

                header('Location: ' . BASE_URL_ADMIN . '?act=tai-khoan');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-them-tai-khoan');
                exit();
            }
        }
    }

    public function formEditTaiKhoan()
    {
        $id = $_GET['id_tai_khoan'] ?? '';
        $taiKhoan = $this->modelTaiKhoan->getDetailTaiKhoan($id);
        $listChucVu = $this->modelChucVu->getAllChucVu();

        if ($taiKhoan) {
            require_once './views/taikhoan/editTaiKhoan.php';
            deleteSessionError();
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=tai-khoan');
            exit();
        }
    }

    public function postEditTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? 1;
            $dia_chi = $_POST['dia_chi'] ?? '';
            $mat_khau = $_POST['mat_khau'] ?? '';
            $chuc_vu_id = $_POST['chuc_vu_id'] ?? '';

            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            $taiKhoanOld = $this->modelTaiKhoan->getDetailTaiKhoan($id);
            $old_file = $taiKhoanOld['anh_dai_dien'] ?? '';

            $new_file = $old_file;
            if ($anh_dai_dien && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {
                $new_file = uploadFile($anh_dai_dien, './uploads/');
                if (!empty($old_file) && file_exists($old_file)) {
                    deleteFile($old_file);
                }
            }

            $errors = [];

            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }

            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            } elseif ($this->modelTaiKhoan->checkEmailExists($email, $id)) {
                $errors['email'] = 'Email đã tồn tại';
            }

            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }

            if (!empty($mat_khau) && strlen($mat_khau) < 6) {
                $errors['mat_khau'] = 'Mật khẩu phải có ít nhất 6 ký tự';
            }

            if (empty($chuc_vu_id)) {
                $errors['chuc_vu_id'] = 'Chức vụ phải được chọn';
            }

            $_SESSION['error'] = $errors;

            if (empty($errors)) {
                $this->modelTaiKhoan->updateTaiKhoan(
                    $id,
                    $ho_ten,
                    $new_file,
                    $ngay_sinh,
                    $email,
                    $so_dien_thoai,
                    $gioi_tinh,
                    $dia_chi,
                    $chuc_vu_id,
                    !empty($mat_khau) ? $mat_khau : null
                );

                header('Location: ' . BASE_URL_ADMIN . '?act=tai-khoan');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-tai-khoan&id_tai_khoan=' . $id);
                exit();
            }
        }
    }

    public function deleteTaiKhoan()
    {
        $id = $_GET['id_tai_khoan'] ?? '';
        $taiKhoan = $this->modelTaiKhoan->getDetailTaiKhoan($id);

        if ($taiKhoan) {
            if (!empty($taiKhoan['anh_dai_dien'])) {
                deleteFile($taiKhoan['anh_dai_dien']);
            }
            $this->modelTaiKhoan->destroyTaiKhoan($id);
        }

        header('Location: ' . BASE_URL_ADMIN . '?act=tai-khoan');
        exit();
    }

    public function toggleTrangThai()
    {
        $id = $_GET['id_tai_khoan'] ?? '';
        $this->modelTaiKhoan->toggleTrangThai($id);

        header('Location: ' . BASE_URL_ADMIN . '?act=tai-khoan');
        exit();
    }
}
?> 