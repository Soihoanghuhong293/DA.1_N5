<?php if (!empty($sanPham)): ?>
<div class="row g-4">
  <div class="col-md-5">
    <?php if (!empty($sanPham['hinh_anh'])): ?>
      <img class="img-fluid rounded" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>" onerror="this.onerror=null; this.replaceWith(document.createTextNode('Không có ảnh'));">
    <?php else: ?>
      <div class="text-muted">Không có ảnh</div>
    <?php endif; ?>
  </div>
  <div class="col-md-7">
    <h2><?= htmlspecialchars($sanPham['ten_san_pham']) ?></h2>
    <p class="text-muted">Danh mục: <?= htmlspecialchars($sanPham['ten_danh_muc']) ?></p>
    <div class="h4 text-danger">
      <?= number_format((int)($sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham']), 0, ',', '.') ?>₫
      <?php if(!empty($sanPham['gia_khuyen_mai'])): ?>
        <small class="text-muted text-decoration-line-through ms-2"><?= number_format((int)$sanPham['gia_san_pham'], 0, ',', '.') ?>₫</small>
      <?php endif; ?>
    </div>
    <p class="mt-3"><?= nl2br(htmlspecialchars($sanPham['mo_ta'] ?? '')) ?></p>
    <form action="<?= BASE_URL ?>?act=them-gio-hang" method="post" class="d-flex align-items-center gap-2 mt-3">
      <input type="hidden" name="id" value="<?= $sanPham['id'] ?>">
      <label class="small">Số lượng</label>
      <input type="number" name="qty" class="form-control" style="width:100px" value="1" min="1">
      <button class="btn btn-primary" type="submit">Thêm vào giỏ</button>
      <a href="<?= BASE_URL ?>?act=danh-sach-san-pham" class="btn btn-outline-secondary">Tiếp tục mua sắm</a>
    </form>
  </div>
</div>
<?php else: ?>
<div class="alert alert-warning">Sản phẩm không tồn tại.</div>
<?php endif; ?> 