<h2 class="mb-3">Thanh toán</h2>
<?php if (empty($items)): ?>
  <div class="alert alert-info">Giỏ hàng trống. <a href="<?= BASE_URL ?>?act=gio-hang">Quay lại giỏ hàng</a></div>
<?php else: ?>
<div class="row g-3">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">Thông tin đơn hàng</div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <?php foreach($items as $it): $sp = $it['sp']; ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong><?= htmlspecialchars($sp['ten_san_pham']) ?></strong>
              <div class="small text-muted">x<?= (int)$it['so_luong'] ?> &middot; <?= number_format($it['don_gia'],0,',','.') ?>₫</div>
            </div>
            <span><?= number_format($it['thanh_tien'],0,',','.') ?>₫</span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">Thanh toán</div>
      <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
          <span>Tổng cộng</span>
          <strong><?= number_format($tong,0,',','.') ?>₫</strong>
        </div>
        <form method="post" class="row g-2">
          <div class="col-12">
            <label class="form-label">Họ tên người nhận</label>
            <input type="text" name="ten_nguoi_nhan" class="form-control" required>
          </div>
          <div class="col-12">
            <label class="form-label">Email người nhận</label>
            <input type="email" name="email_nguoi_nhan" class="form-control" required>
          </div>
          <div class="col-6">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="sdt_nguoi_nhan" class="form-control" required>
          </div>
          <div class="col-6">
            <label class="form-label">Phương thức thanh toán</label>
            <select name="phuong_thuc_thanh_toan_id" class="form-select">
              <option value="1">Thanh toán khi nhận hàng (COD)</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Địa chỉ nhận hàng</label>
            <textarea name="dia_chi_nguoi_nhan" class="form-control" rows="2" required></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Ghi chú</label>
            <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Ví dụ: Giao giờ hành chính..."></textarea>
          </div>
          <div class="col-12">
            <button class="btn btn-success w-100" type="submit">Đặt hàng</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?> 