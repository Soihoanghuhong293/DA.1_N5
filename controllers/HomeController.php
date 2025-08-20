<?php 

class HomeController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        // Khởi tạo model SanPham
        $this->modelSanPham = new SanPham();
        // Khởi tạo model DanhMuc
        if (class_exists('DanhMuc')) {
            $this->modelDanhMuc = new DanhMuc();
        }
    }
    public function home()
    {
       $danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
       $sanPhamsMoi = $this->modelSanPham->getLatestProducts(8);
       require_once './views/layout/header.php';
       require_once './views/home.php';
       require_once './views/layout/footer.php';
    }
    public function tranhChu()
    {
        return $this->home();
    }
    public function danhSachSanPham()
    {
        $danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
        $listProduct = $this->modelSanPham->getAllProduct();
        require_once './views/layout/header.php';
        require_once './views/product_list.php';
        require_once './views/layout/footer.php';
    }
    public function chiTietSanPham()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL);
            exit;
        }
        $danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
        $sanPham = $this->modelSanPham->getProductById($id);
        if (!$sanPham) {
            header('Location: ' . BASE_URL);
            exit;
        }
        require_once './views/layout/header.php';
        require_once './views/product_detail.php';
        require_once './views/layout/footer.php';
    }

    // Hiển thị danh sách danh mục hoặc sản phẩm theo danh mục
    public function danhMuc()
    {
        $cid = $_GET['id'] ?? null;
        $danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
        if (!$cid) {
            // Trang danh sách danh mục
            require_once './views/layout/header.php';
            require_once './views/category_list.php';
            require_once './views/layout/footer.php';
            return;
        }
        // Trang sản phẩm theo danh mục
        $listProduct = $this->modelSanPham->getProductsByCategory($cid);
        $currentCategory = $this->modelDanhMuc ? $this->modelDanhMuc->getDetailDanhMuc($cid) : null;
        require_once './views/layout/header.php';
        require_once './views/product_list.php';
        require_once './views/layout/footer.php';
    }
}