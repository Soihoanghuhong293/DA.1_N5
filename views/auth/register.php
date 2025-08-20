<h2 class="mb-3">Đăng ký</h2>
<form method="post" class="row g-3" novalidate>
  <div class="col-12 col-md-6">
    <label class="form-label">Họ tên</label>
    <input type="text" name="ho_ten" class="form-control <?= !empty($errors['ho_ten']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['ho_ten'] ?? '') ?>">
    <?php if (!empty($errors['ho_ten'])): ?><div class="invalid-feedback"><?= $errors['ho_ten'] ?></div><?php endif; ?>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label">Số điện thoại</label>
    <input type="text" name="so_dien_thoai" class="form-control" value="<?= htmlspecialchars($old['so_dien_thoai'] ?? '') ?>">
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
    <?php if (!empty($errors['email'])): ?><div class="invalid-feedback"><?= $errors['email'] ?></div><?php endif; ?>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label">Mật khẩu</label>
    <input type="password" name="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>">
    <?php if (!empty($errors['password'])): ?><div class="invalid-feedback"><?= $errors['password'] ?></div><?php endif; ?>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label">Xác nhận mật khẩu</label>
    <input type="password" name="confirm_password" class="form-control <?= !empty($errors['confirm_password']) ? 'is-invalid' : '' ?>">
    <?php if (!empty($errors['confirm_password'])): ?><div class="invalid-feedback"><?= $errors['confirm_password'] ?></div><?php endif; ?>
  </div>

  <div class="col-12 d-flex gap-2">
    <button class="btn btn-primary" type="submit">Đăng ký</button>
    <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>?act=dang-nhap">Đăng nhập</a>
  </div>
</form> 