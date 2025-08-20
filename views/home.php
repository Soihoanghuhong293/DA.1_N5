<div class="p-4 p-md-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-6 fw-bold">Chào mừng đến với Baby Store</h1>
    <p class="col-md-8 fs-5">Cửa hàng đồ trẻ em: quần áo, phụ kiện, chăm sóc bé... Mua sắm dễ dàng và an toàn.</p>
    <a class="btn btn-primary btn-lg" href="<?= BASE_URL ?>?act=danh-sach-san-pham">Mua sắm ngay</a>
  </div>
</div>

<h2 class="mb-3">Sản phẩm mới</h2>
<div class="row g-3">
  <?php if (!empty($sanPhamsMoi)): foreach($sanPhamsMoi as $sp): ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card product-card h-100">
        <a href="<?= BASE_URL ?>?act=chi-tiet-san-pham&id=<?= $sp['id'] ?>" class="text-decoration-none text-dark">
          <?php if (!empty($sp['hinh_anh'])): ?>
          <img src="<?= BASE_URL . $sp['hinh_anh'] ?>" class="card-img-top" alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>" onerror="this.onerror=null; this.replaceWith(document.createTextNode('Không có ảnh'));">
          <?php else: ?>
          <div class="text-center text-muted py-5">Không có ảnh</div>
          <?php endif; ?>
          <div class="card-body">
            <h6 class="card-title line-clamp-2"><?= htmlspecialchars($sp['ten_san_pham']) ?></h6>
            <div class="fw-bold text-danger">
              <?= number_format((int)($sp['gia_khuyen_mai'] ?: $sp['gia_san_pham']), 0, ',', '.') ?>₫
              <?php if(!empty($sp['gia_khuyen_mai'])): ?>
                <small class="text-muted text-decoration-line-through ms-2"><?= number_format((int)$sp['gia_san_pham'], 0, ',', '.') ?>₫</small>
              <?php endif; ?>
            </div>
          </div>
        </a>
      </div>
    </div>
  <?php endforeach; else: ?>
    <div class="col-12"><div class="alert alert-info">Chưa có sản phẩm.</div></div>
  <?php endif; ?>
</div> 