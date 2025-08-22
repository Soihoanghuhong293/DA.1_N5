<?php include './views/layout/header.php' ?>
<?php include './views/layout/navbar.php' ?>
<?php include './views/layout/sidebar.php' ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Khách hàng</h1></div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listTaiKhoan as $k => $tk): ?>
                <tr>
                  <td><?= $k+1 ?></td>
                  <td><?= htmlspecialchars($tk['ho_ten']) ?></td>
                  <td><?= htmlspecialchars($tk['email']) ?></td>
                  <td><?= htmlspecialchars($tk['so_dien_thoai']) ?></td>
                  <td><?= (int)$tk['trang_thai'] === 1 ? '<span class="badge badge-success">Hoạt động</span>' : '<span class="badge badge-secondary">Khoá</span>' ?></td>
                  <td>
                    <a class="btn btn-sm btn-warning" href="<?= BASE_URL_ADMIN ?>?act=form-sua-tai-khoan&id_tai_khoan=<?= $tk['id'] ?>">Sửa</a>
                    <a class="btn btn-sm btn-danger" onclick="return confirm('Xóa tài khoản này?')" href="<?= BASE_URL_ADMIN ?>?act=xoa-tai-khoan&id_tai_khoan=<?= $tk['id'] ?>">Xóa</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Lịch sử comment</h1></div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listTaiKhoan as $k => $tk): ?>
                <tr>
                  <td><?= $k+1 ?></td>
                  <td><?= htmlspecialchars($tk['ho_ten']) ?></td>
                  <td><?= htmlspecialchars($tk['email']) ?></td>
                  <td><?= htmlspecialchars($tk['so_dien_thoai']) ?></td>
                  <td><?= (int)$tk['trang_thai'] === 1 ? '<span class="badge badge-success">Hoạt động</span>' : '<span class="badge badge-secondary">Khoá</span>' ?></td>
                  <td>
                    <a class="btn btn-sm btn-warning" href="<?= BASE_URL_ADMIN ?>?act=form-sua-tai-khoan&id_tai_khoan=<?= $tk['id'] ?>">Sửa</a>
                    <a class="btn btn-sm btn-danger" onclick="return confirm('Xóa tài khoản này?')" href="<?= BASE_URL_ADMIN ?>?act=xoa-tai-khoan&id_tai_khoan=<?= $tk['id'] ?>">Xóa</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
  </section>
</div>


<?php include './views/layout/footer.php'; ?> 