<?php
class AdminDonHangController
{
    public $modelDonHang;
    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }

    public function chiTietDonHang()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location:' . BASE_URL_ADMIN . '?act=don-hang');
            exit;
        }
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $items = $this->modelDonHang->getItems($id);
        require_once './views/donhang/detailDonHang.php';
    }

    public function capNhatTrangThai()
    {
        $id = $_POST['id'] ?? null;
        $status = $_POST['trang_thai_id'] ?? null;
        if ($id && $status) {
            $this->modelDonHang->updateTrangThai($id, $status);
        }
        header('Location:' . BASE_URL_ADMIN . '?act=don-hang');
        exit;
    }
} 