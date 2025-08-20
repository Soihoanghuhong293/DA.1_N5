<h2 class="mb-3">Giỏ hàng</h2>
<?php if (empty($items)): ?>
  <div class="alert alert-info">Giỏ hàng trống. <a href="<?= BASE_URL ?>?act=danh-sach-san-pham">Tiếp tục mua sắm</a></div>
<?php else: ?>
<form method="post" action="<?= BASE_URL ?>?act=cap-nhat-gio-hang">
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>Sản phẩm</th><th class="text-end">Đơn giá</th><th class="text-center">Số lượng</th><th class="text-end">Thành tiền</th><th></th></tr></thead>
      <tbody>
        <?php foreach($items as $it): $sp = $it['sp']; ?>
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <img src="<?= BASE_URL . $sp['hinh_anh'] ?>" width="60" height="60" style="object-fit:cover" alt="">
              <a href="<?= BASE_URL ?>?act=chi-tiet-san-pham&id=<?= $sp['id'] ?>" class="text-decoration-none"><?= htmlspecialchars($sp['ten_san_pham']) ?></a>
            </div>
          </td>
          <td class="text-end"><?= number_format($it['don_gia'],0,',','.') ?>₫</td>
          <td class="text-center" style="width:140px">
            <input type="number" min="0" name="qty[<?= $sp['id'] ?>]" value="<?= (int)$it['so_luong'] ?>" class="form-control form-control-sm text-center">
          </td>
          <td class="text-end"><?= number_format($it['thanh_tien'],0,',','.') ?>₫</td>
          <td class="text-end"><a href="<?= BASE_URL ?>?act=xoa-khoi-gio&id=<?= $sp['id'] ?>" class="btn btn-sm btn-outline-danger">Xóa</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Tổng cộng</th>
          <th class="text-end"><?= number_format($tong,0,',','.') ?>₫</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="d-flex gap-2">
    <a href="<?= BASE_URL ?>?act=danh-sach-san-pham" class="btn btn-outline-secondary">Tiếp tục mua sắm</a>
    <button class="btn btn-primary" type="submit">Cập nhật giỏ hàng</button>
    <a href="<?= BASE_URL ?>?act=thanh-toan" class="btn btn-success ms-auto">Thanh toán</a>
  </div>
</form>
<?php endif; ?> 