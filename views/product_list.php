<h2 class="mb-3">
  <?php if (!empty($currentCategory)): ?>
    Danh mục: <?= htmlspecialchars($currentCategory['ten_danh_muc']) ?>
  <?php else: ?>
    Tất cả sản phẩm
  <?php endif; ?>
</h2>
<div class="row g-3">
  <?php if (!empty($listProduct)): foreach($listProduct as $sp): ?>
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
    <div class="col-12"><div class="alert alert-info">Không có sản phẩm để hiển thị.</div></div>
  <?php endif; ?>
</div> 