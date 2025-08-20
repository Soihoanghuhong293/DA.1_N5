<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Khởi tạo session cho frontend
session_start();

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/AuthController.php';
require_once './controllers/CartController.php';

// Require toàn bộ file Models
require_once './models/Student.php';
require_once './models/SanPham.php';
require_once './models/DanhMuc.php';
require_once './models/TaiKhoan.php';
require_once './models/Cart.php';
require_once './models/DonHang.php';

// Route
$act = $_GET['act'] ?? '/';
// // var_dump($_GET['act']);die();

// if ($_GET['act']) {
//     $act = $_GET['act'];
// } else {
//     $act = '/';
// }

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {

// route  
    '/' =>(new HomeController())->home(), // trường hợp đặc biệt
    
    'trangchu' =>(new HomeController())->tranhChu(),
    //BASE_URL /admin/?act=trangchu

    'danh-sach-san-pham' => (new HomeController())->danhSachSanPham(),
     //BASE_URL /?act=danh-sach-san-pham 

    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),

    // Gộp danh mục: nếu không có id sẽ hiển thị danh sách danh mục, có id sẽ hiển thị sản phẩm theo danh mục
    'danh-muc' => (new HomeController())->danhMuc(),

    // Auth
    'dang-nhap' => (new AuthController())->dangNhap(),
    'dang-ky'   => (new AuthController())->dangKy(),
    'dang-xuat' => (new AuthController())->dangXuat(),

    // Cart
    'them-gio-hang'    => (new CartController())->add(),
    'gio-hang'         => (new CartController())->view(),
    'cap-nhat-gio-hang'=> (new CartController())->update(),
    'xoa-khoi-gio'     => (new CartController())->remove(),
    'thanh-toan'       => (new CartController())->checkout(),
    'don-hang-cua-toi' => (new CartController())->myOrders(),
};

