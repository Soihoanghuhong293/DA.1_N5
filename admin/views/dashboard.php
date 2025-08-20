<?php include './views/layout/header.php' ?>
<?php include './views/layout/navbar.php' ?>
<?php include './views/layout/sidebar.php' ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Dashboard</h1></div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row g-3">
        <div class="col-md-6 col-lg-4">
          <a class="btn btn-outline-primary w-100 py-4" href="<?= BASE_URL_ADMIN ?>?act=danh-muc">
            <i class="fas fa-th me-2"></i>Danh mục sản phẩm
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a class="btn btn-outline-primary w-100 py-4" href="<?= BASE_URL_ADMIN ?>?act=san-pham">
            <i class="fas fa-baby me-2"></i>Sản phẩm
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a class="btn btn-outline-primary w-100 py-4" href="<?= BASE_URL_ADMIN ?>?act=tai-khoan">
            <i class="fas fa-users me-2"></i>Người dùng
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a class="btn btn-outline-primary w-100 py-4" href="<?= BASE_URL_ADMIN ?>?act=khach-hang">
            <i class="fas fa-user me-2"></i>Khách hàng
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a class="btn btn-outline-primary w-100 py-4" href="<?= BASE_URL_ADMIN ?>?act=don-hang">
            <i class="fas fa-receipt me-2"></i>Đơn hàng
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include './views/layout/footer.php'; ?> 