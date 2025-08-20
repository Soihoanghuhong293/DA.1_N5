<h2 class="mb-3">Đơn hàng của tôi</h2>
<?php if (empty($orders)): ?>
  <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
<?php else: ?>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>#</th><th>Ngày tạo</th><th>Ghi chú</th><th class="text-end">Tổng tiền</th><th>Trạng thái</th></tr></thead>
      <tbody>
      <?php foreach($orders as $dh): ?>
        <tr>
          <td><?= $dh['id'] ?></td>
          <td><?= htmlspecialchars($dh['created_at'] ?? '') ?></td>
          <td><?= htmlspecialchars($dh['ghi_chu'] ?? '') ?></td>
          <td class="text-end"><?= number_format($dh['tong_tien'] ?? 0,0,',','.') ?>₫</td>
          <td>
            <?php $st = $dh['trang_thai'] ?? 'pending'; ?>
            <?php if ($st === 'pending'): ?><span class="badge text-bg-secondary">Chờ xử lý</span><?php endif; ?>
            <?php if ($st === 'confirmed'): ?><span class="badge text-bg-primary">Đã xác nhận</span><?php endif; ?>
            <?php if ($st === 'shipping'): ?><span class="badge text-bg-info">Đang giao</span><?php endif; ?>
            <?php if ($st === 'completed'): ?><span class="badge text-bg-success">Hoàn tất</span><?php endif; ?>
            <?php if ($st === 'cancelled'): ?><span class="badge text-bg-danger">Đã hủy</span><?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?> 