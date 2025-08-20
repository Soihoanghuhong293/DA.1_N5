<h2 class="mb-3">Danh mục</h2>
<div class="row g-3">
<?php if (!empty($danhMucs)): foreach($danhMucs as $dm): ?>
  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <a class="card text-decoration-none text-dark h-100" href="<?= BASE_URL ?>?act=danh-muc&id=<?= $dm['id'] ?>">
      <div class="card-body d-flex flex-column justify-content-between">
        <h6 class="card-title mb-2"><?= htmlspecialchars($dm['ten_danh_muc']) ?></h6>
        <span class="text-primary">Xem sản phẩm →</span>
      </div>
    </a>
  </div>
<?php endforeach; else: ?>
  <div class="col-12"><div class="alert alert-info">Chưa có danh mục.</div></div>
<?php endif; ?>
</div> 