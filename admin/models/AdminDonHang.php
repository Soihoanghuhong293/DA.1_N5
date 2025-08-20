<?php 
class AdminDonHang
{
	public $conn;
	public function __construct()
	{
		$this->conn = connectDB();
	}

	public function getAllDonHang()
	{
		try {
			$sql = "SELECT dh.*, tk.ho_ten, tk.email 
				FROM don_hangs dh 
				LEFT JOIN tai_khoans tk ON dh.tai_khoan_id = tk.id 
				ORDER BY dh.id DESC";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "lỗi" . $e->getMessage();
		}
	}

	public function getDetailDonHang($id)
	{
		try {
			$sql = "SELECT dh.*, tk.ho_ten, tk.email 
				FROM don_hangs dh 
				LEFT JOIN tai_khoans tk ON dh.tai_khoan_id = tk.id 
				WHERE dh.id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':id' => $id]);
			return $stmt->fetch();
		} catch (Exception $e) {
			echo "lỗi" . $e->getMessage();
		}
	}

	public function getItems($donHangId)
	{
		try {
			$sql = "SELECT ct.*, sp.ten_san_pham 
				FROM chi_tiet_don_hangs ct 
				INNER JOIN san_phams sp ON ct.san_pham_id = sp.id 
				WHERE ct.don_hang_id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':id' => $donHangId]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			echo "lỗi" . $e->getMessage();
		}
	}

	public function updateTrangThai($id, $statusId)
	{
		try {
			$sql = "UPDATE don_hangs SET trang_thai_id = :st WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':st' => (int)$statusId, ':id' => $id]);
			return true;
		} catch (Exception $e) {
			echo "lỗi" . $e->getMessage();
		}
	}
} 