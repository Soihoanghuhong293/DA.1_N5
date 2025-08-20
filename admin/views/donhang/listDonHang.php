<!-- Header -->
<?php include './views/layout/header.php' ?>
<?php include './views/layout/navbar.php' ?>
<?php include './views/layout/sidebar.php' ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Quản lý đơn hàng</h1></div>
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
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th class="text-right">Tổng tiền</th>
                <th>Trạng thái</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listDonHang as $k => $dh): ?>
              <tr>
                <td><?= $k+1 ?></td>
                <td><?= htmlspecialchars($dh['ma_don_hang'] ?? ('DH'.$dh['id'])) ?></td>
                <td><?= htmlspecialchars($dh['ho_ten'] ?? $dh['email'] ?? '') ?></td>
                <td><?= htmlspecialchars($dh['ngay_dat'] ?? '') ?></td>
                <td class="text-right"><?= number_format((float)($dh['tong_tien'] ?? 0),0,',','.') ?>₫</td>
                <td>
                  <?php $st = (int)($dh['trang_thai_id'] ?? 1); ?>
                  <?php if ($st==1): ?><span class="badge badge-secondary">Chờ xử lý</span><?php endif; ?>
                  <?php if ($st==2): ?><span class="badge badge-primary">Đã xác nhận</span><?php endif; ?>
                  <?php if ($st==3): ?><span class="badge badge-info">Đang giao</span><?php endif; ?>
                  <?php if ($st==4): ?><span class="badge badge-success">Hoàn tất</span><?php endif; ?>
                  <?php if ($st==5): ?><span class="badge badge-danger">Đã hủy</span><?php endif; ?>
                </td>
                <td>
                  <a class="btn btn-sm btn-primary" href="<?= BASE_URL_ADMIN ?>?act=chi-tiet-don-hang&id=<?= $dh['id'] ?>">Chi tiết</a>
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