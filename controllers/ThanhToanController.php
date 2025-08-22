<?php
class ThanhToanController {
    private $orderModel;

    public function __construct() {
        require_once "models/OrderModel.php";
        $this->orderModel = new OrderModel();
    }

    // Hiển thị form
    public function index() {
        $items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $tong = 0;
        foreach ($items as &$it) {
            $it['thanh_tien'] = $it['so_luong'] * $it['don_gia'];
            $tong += $it['thanh_tien'];
        }
        include "views/checkout.php"; // chính là file form bạn đã có
    }

    // Xử lý khi bấm "Đặt hàng"
    public function datHang() {
        $ten = $_POST['ten_nguoi_nhan'];
        $email = $_POST['email_nguoi_nhan'];
        $sdt = $_POST['sdt_nguoi_nhan'];
        $diachi = $_POST['dia_chi_nguoi_nhan'];
        $ghichu = $_POST['ghi_chu'];
        $pttt = $_POST['phuong_thuc_thanh_toan_id'];

        $items = $_SESSION['cart'] ?? [];
        $tong = 0;
        foreach ($items as &$it) {
            $it['thanh_tien'] = $it['so_luong'] * $it['don_gia'];
            $tong += $it['thanh_tien'];
        }

        if ($pttt == 1) {
            // COD
            $orderId = $this->orderModel->createCOD($ten,$email,$sdt,$diachi,$ghichu,$items,$tong);
            unset($_SESSION['cart']);
            header("Location: index.php?act=dat-hang-thanh-cong&id=".$orderId);
            exit;
        } elseif ($pttt == 2) {
            // VNPay
            require_once "services/payment/vnpay_create_payment.php";
        }
    }

    public function vnpayReturn() {
        require_once "services/payment/vnpay_return.php";
    }
}
