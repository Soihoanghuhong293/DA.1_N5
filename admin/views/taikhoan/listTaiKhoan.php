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
          <h1>Quản lý người dùng</h1>
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
              <a href="<?= BASE_URL_ADMIN . '?act=form-them-tai-khoan' ?>">
                <button class="btn btn-success">Thêm người dùng mới</button>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Ảnh đại diện</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Chức vụ</th>
                    <th>Trạng thái</th>
                    <th>Thao Tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listTaiKhoan as $key => $taiKhoan): ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td>
                        <img src="<?= BASE_URL . $taiKhoan['anh_dai_dien'] ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" alt=""
                          onerror="this.onerror=null; this.src='https://via.placeholder.com/50x50?text=Avatar'">
                      </td>
                      <td><?= $taiKhoan['ho_ten'] ?></td>
                      <td><?= $taiKhoan['email'] ?></td>
                      <td><?= $taiKhoan['so_dien_thoai'] ?></td>
                      <td><?= $taiKhoan['ten_chuc_vu'] ?></td>
                      <td>
                        <span class="badge badge-<?= $taiKhoan['trang_thai'] ? 'success' : 'danger' ?>">
                          <?= $taiKhoan['trang_thai'] ? 'Hoạt động' : 'Khóa' ?>
                        </span>
                      </td>
                      <td>
                        <div class="btn-group">
                          <a href="<?= BASE_URL_ADMIN . '?act=form-sua-tai-khoan&id_tai_khoan=' . $taiKhoan['id'] ?>">
                            <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=toggle-trang-thai-tai-khoan&id_tai_khoan=' . $taiKhoan['id'] ?>" 
                             onclick="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái người dùng này?')">
                            <button class="btn btn-info btn-sm">
                              <i class="fas fa-<?= $taiKhoan['trang_thai'] ? 'lock' : 'unlock' ?>"></i>
                            </button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=xoa-tai-khoan&id_tai_khoan=' . $taiKhoan['id'] ?>" 
                             onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Ảnh đại diện</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Chức vụ</th>
                    <th>Trạng thái</th>
                    <th>Thao Tác</th>
                  </tr>
                </tfoot>
              </table>
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

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> 