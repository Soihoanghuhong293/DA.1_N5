<?php include './views/layout/header.php' ?>
<?php include './views/layout/navbar.php' ?>
<?php include './views/layout/sidebar.php' ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Chi tiết đơn hàng</h1></div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">Sản phẩm</div>
            <div class="card-body p-0">
              <table class="table m-0">
                <thead><tr><th>Sản phẩm</th><th class="text-center">SL</th><th class="text-end">Đơn giá</th><th class="text-end">Thành tiền</th></tr></thead>
                <tbody>
                <?php foreach($items as $it): ?>
                  <tr>
                    <td><?= htmlspecialchars($it['ten_san_pham']) ?></td>
                    <td class="text-center"><?= (int)$it['so_luong'] ?></td>
                    <td class="text-end"><?= number_format($it['don_gia'],0,',','.') ?>₫</td>
                    <td class="text-end"><?= number_format($it['thanh_tien'],0,',','.') ?>₫</td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">Thông tin đơn</div>
            <div class="card-body">
              <div class="mb-2">Mã đơn: <strong><?= htmlspecialchars($donHang['ma_don_hang'] ?? ('DH'.$donHang['id'])) ?></strong></div>
              <div class="mb-2">Khách hàng: <strong><?= htmlspecialchars($donHang['ho_ten'] ?? $donHang['email'] ?? '') ?></strong></div>
              <div class="mb-2">Ngày đặt: <strong><?= htmlspecialchars($donHang['ngay_dat'] ?? '') ?></strong></div>
              <div class="mb-2">Tổng tiền: <strong><?= number_format((float)($donHang['tong_tien'] ?? 0),0,',','.') ?>₫</strong></div>

              <form action="<?= BASE_URL_ADMIN ?>?act=cap-nhat-trang-thai-don-hang" method="post" class="mt-3">
                <input type="hidden" name="id" value="<?= $donHang['id'] ?>">
                <label class="form-label">Trạng thái</label>
                <select name="trang_thai_id" class="form-control">
                  <option value="1" <?= (int)($donHang['trang_thai_id'] ?? 1)===1?'selected':'' ?>>Chờ xử lý</option>
                  <option value="2" <?= (int)($donHang['trang_thai_id'] ?? 1)===2?'selected':'' ?>>Đã xác nhận</option>
                  <option value="3" <?= (int)($donHang['trang_thai_id'] ?? 1)===3?'selected':'' ?>>Đang giao</option>
                  <option value="4" <?= (int)($donHang['trang_thai_id'] ?? 1)===4?'selected':'' ?>>Hoàn tất</option>
                  <option value="5" <?= (int)($donHang['trang_thai_id'] ?? 1)===5?'selected':'' ?>>Đã hủy</option>
                </select>
                <button class="btn btn-primary mt-2" type="submit">Cập nhật</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?> 