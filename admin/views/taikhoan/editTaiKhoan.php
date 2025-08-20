<!-- <header> -->
<?php include './views/layout/header.php' ?>
<!-- End header -->

<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php' ?>
<!-- End sidebar  -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sửa thông tin người dùng</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Thông tin người dùng</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?= BASE_URL_ADMIN . '?act=sua-tai-khoan' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $taiKhoan['id'] ?>">
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ho_ten">Họ tên <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="ho_ten" name="ho_ten" 
                             value="<?= isset($_SESSION['error']) && isset($_POST['ho_ten']) ? $_POST['ho_ten'] : $taiKhoan['ho_ten'] ?>" required>
                      <?php if (isset($_SESSION['error']['ho_ten'])): ?>
                        <span class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" id="email" name="email" 
                             value="<?= isset($_SESSION['error']) && isset($_POST['email']) ? $_POST['email'] : $taiKhoan['email'] ?>" required>
                      <?php if (isset($_SESSION['error']['email'])): ?>
                        <span class="text-danger"><?= $_SESSION['error']['email'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="so_dien_thoai">Số điện thoại <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" 
                             value="<?= isset($_SESSION['error']) && isset($_POST['so_dien_thoai']) ? $_POST['so_dien_thoai'] : $taiKhoan['so_dien_thoai'] ?>" required>
                      <?php if (isset($_SESSION['error']['so_dien_thoai'])): ?>
                        <span class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="ngay_sinh">Ngày sinh</label>
                      <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" 
                             value="<?= isset($_SESSION['error']) && isset($_POST['ngay_sinh']) ? $_POST['ngay_sinh'] : $taiKhoan['ngay_sinh'] ?>">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="gioi_tinh">Giới tính</label>
                      <select class="form-control" id="gioi_tinh" name="gioi_tinh">
                        <option value="1" <?= (isset($_POST['gioi_tinh']) ? $_POST['gioi_tinh'] : $taiKhoan['gioi_tinh']) == '1' ? 'selected' : '' ?>>Nam</option>
                        <option value="0" <?= (isset($_POST['gioi_tinh']) ? $_POST['gioi_tinh'] : $taiKhoan['gioi_tinh']) == '0' ? 'selected' : '' ?>>Nữ</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="chuc_vu_id">Chức vụ <span class="text-danger">*</span></label>
                      <select class="form-control" id="chuc_vu_id" name="chuc_vu_id" required>
                        <option value="">Chọn chức vụ</option>
                        <?php foreach ($listChucVu as $chucVu): ?>
                          <option value="<?= $chucVu['id'] ?>" <?= (isset($_POST['chuc_vu_id']) ? $_POST['chuc_vu_id'] : $taiKhoan['chuc_vu_id']) == $chucVu['id'] ? 'selected' : '' ?>>
                            <?= $chucVu['ten_chuc_vu'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                      <?php if (isset($_SESSION['error']['chuc_vu_id'])): ?>
                        <span class="text-danger"><?= $_SESSION['error']['chuc_vu_id'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="mat_khau">Mật khẩu mới (để trống nếu không đổi)</label>
                      <input type="password" class="form-control" id="mat_khau" name="mat_khau">
                      <?php if (isset($_SESSION['error']['mat_khau'])): ?>
                        <span class="text-danger"><?= $_SESSION['error']['mat_khau'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="anh_dai_dien">Ảnh đại diện</label>
                      <?php if (!empty($taiKhoan['anh_dai_dien'])): ?>
                        <div class="mb-2">
                          <img src="<?= BASE_URL . $taiKhoan['anh_dai_dien'] ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;" alt="Ảnh hiện tại">
                          <p class="text-muted">Ảnh hiện tại</p>
                        </div>
                      <?php endif; ?>
                      <input type="file" class="form-control-file" id="anh_dai_dien" name="anh_dai_dien" accept="image/*">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="dia_chi">Địa chỉ</label>
                      <textarea class="form-control" id="dia_chi" name="dia_chi" rows="3"><?= isset($_SESSION['error']) && isset($_POST['dia_chi']) ? $_POST['dia_chi'] : $taiKhoan['dia_chi'] ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                  <a href="<?= BASE_URL_ADMIN . '?act=tai-khoan' ?>" class="btn btn-secondary">Hủy</a>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- <Footer> -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer --> 