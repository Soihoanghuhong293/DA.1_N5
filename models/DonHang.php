<?php

class DonHang
{
	protected $conn;

	public function __construct()
	{
		$this->conn = connectDB();
	}

	// Tạo đơn hàng theo schema: ma_don_hang, tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ngay_dat, tong_tien, ghi_chu, phuong_thuc_thanh_toan_id, trang_thai_id
	public function taoDonHang($userId, $tongTien, $ghiChu = null, $tenNguoiNhan = '', $emailNguoiNhan = '', $sdtNguoiNhan = '', $diaChiNguoiNhan = '', $ptttId = 1)
	{
		$maDon = 'DH' . date('YmdHis');
		$sql = 'INSERT INTO don_hangs (ma_don_hang, tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ngay_dat, tong_tien, ghi_chu, phuong_thuc_thanh_toan_id, trang_thai_id)
		VALUES (:ma, :uid, :ten, :email, :sdt, :diachi, CURDATE(), :tong, :note, :pttt, :ttid)';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([
			':ma' => $maDon,
			':uid' => $userId,
			':ten' => $tenNguoiNhan,
			':email' => $emailNguoiNhan,
			':sdt' => $sdtNguoiNhan,
			':diachi' => $diaChiNguoiNhan,
			':tong' => $tongTien,
			':note' => $ghiChu,
			':pttt' => (int)$ptttId,
			':ttid' => 1,
		]);
		return $this->conn->lastInsertId();
	}

	public function themChiTiet($donHangId, $sanPhamId, $soLuong, $donGia)
	{
		$sql = 'INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien) VALUES (:dh, :sp, :gia, :sl, :tt)';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([
			':dh' => $donHangId,
			':sp' => $sanPhamId,
			':gia' => $donGia,
			':sl' => $soLuong,
			':tt' => $soLuong * $donGia,
		]);
	}

	public function getDonHangByUser($userId)
	{
		$sql = 'SELECT * FROM don_hangs WHERE tai_khoan_id = :uid ORDER BY id DESC';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':uid' => $userId]);
		return $stmt->fetchAll();
	}

	public function getChiTiet($donHangId)
	{
		$sql = 'SELECT ct.*, sp.ten_san_pham FROM chi_tiet_don_hangs ct INNER JOIN san_phams sp ON ct.san_pham_id = sp.id WHERE ct.don_hang_id = :id';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':id' => $donHangId]);
		return $stmt->fetchAll();
	}

	public function capNhatTrangThai($donHangId, $trangThaiId)
	{
		$sql = 'UPDATE don_hangs SET trang_thai_id = :tt WHERE id = :id';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':tt' => (int)$trangThaiId, ':id' => $donHangId]);
	}
} 