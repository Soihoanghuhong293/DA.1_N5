<?php

class CartController
{
	protected $modelSanPham;
	protected $modelDonHang;
	protected $modelDanhMuc;

	public function __construct()
	{
		$this->modelSanPham = new SanPham();
		$this->modelDonHang = new DonHang();
		if (class_exists('DanhMuc')) {
			$this->modelDanhMuc = new DanhMuc();
		}
	}

	public function add()
	{
		$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
		$qty = (int)($_POST['qty'] ?? 1);
		if ($id > 0) {
			Cart::addItem($id, $qty);
		}
		header('Location: ' . BASE_URL . '?act=gio-hang');
		exit;
	}

	public function view()
	{
		$danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
		$cart = Cart::getCart();
		$items = [];
		$tong = 0;
		if (!empty($cart)) {
			$ids = array_keys($cart);
			foreach ($ids as $pid) {
				$sp = $this->modelSanPham->getProductById($pid);
				if ($sp) {
					$soLuong = $cart[$pid];
					$donGia = (int)($sp['gia_khuyen_mai'] ?: $sp['gia_san_pham']);
					$items[] = ['sp' => $sp, 'so_luong' => $soLuong, 'don_gia' => $donGia, 'thanh_tien' => $soLuong * $donGia];
					$tong += $soLuong * $donGia;
				}
			}
		}
		require_once './views/layout/header.php';
		require_once './views/cart/view.php';
		require_once './views/layout/footer.php';
	}

	public function update()
	{
		if (!empty($_POST['qty'])) {
			Cart::updateQuantities($_POST['qty']);
		}
		header('Location: ' . BASE_URL . '?act=gio-hang');
		exit;
	}

	public function remove()
	{
		$id = (int)($_GET['id'] ?? 0);
		if ($id > 0) {
			Cart::remove($id);
		}
		header('Location: ' . BASE_URL . '?act=gio-hang');
		exit;
	}

	public function checkout()
	{
		if (empty($_SESSION['user'])) {
			header('Location: ' . BASE_URL . '?act=dang-nhap');
			exit;
		}
		$danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
		$cart = Cart::getCart();
		$items = [];
		$tong = 0;
		foreach ($cart as $pid => $qty) {
			$sp = $this->modelSanPham->getProductById((int)$pid);
			if ($sp) {
				$donGia = (int)($sp['gia_khuyen_mai'] ?: $sp['gia_san_pham']);
				$items[] = ['sp' => $sp, 'so_luong' => $qty, 'don_gia' => $donGia, 'thanh_tien' => $qty * $donGia];
				$tong += $qty * $donGia;
			}
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($tong <= 0) {
				header('Location: ' . BASE_URL . '?act=gio-hang');
				exit;
			}
			$ghiChu = trim($_POST['ghi_chu'] ?? '');
			$ten = trim($_POST['ten_nguoi_nhan'] ?? '');
			$email = trim($_POST['email_nguoi_nhan'] ?? '');
			$sdt = trim($_POST['sdt_nguoi_nhan'] ?? '');
			$diachi = trim($_POST['dia_chi_nguoi_nhan'] ?? '');
			$pttt = (int)($_POST['phuong_thuc_thanh_toan_id'] ?? 1);
			$orderId = $this->modelDonHang->taoDonHang($_SESSION['user']['id'], $tong, $ghiChu, $ten, $email, $sdt, $diachi, $pttt);
			foreach ($items as $it) {
				$this->modelDonHang->themChiTiet($orderId, $it['sp']['id'], $it['so_luong'], $it['don_gia']);
			}
			Cart::clear();
			header('Location: ' . BASE_URL . '?act=don-hang-cua-toi');
			exit;
		}

		require_once './views/layout/header.php';
		require_once './views/cart/checkout.php';
		require_once './views/layout/footer.php';
	}

	public function myOrders()
	{
		if (empty($_SESSION['user'])) {
			header('Location: ' . BASE_URL . '?act=dang-nhap');
			exit;
		}
		$danhMucs = $this->modelDanhMuc ? $this->modelDanhMuc->getAllDanhMuc() : [];
		$orders = $this->modelDonHang->getDonHangByUser($_SESSION['user']['id']);
		require_once './views/layout/header.php';
		require_once './views/cart/orders.php';
		require_once './views/layout/footer.php';
	}
} 