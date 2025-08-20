<h2 class="mb-3">Đăng nhập</h2>
<?php if (!empty($errors['general'])): ?>
  <div class="alert alert-danger"><?= $errors['general'] ?></div>
<?php endif; ?>
<form method="post" class="row g-3" novalidate>
  <div class="col-12 col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <?php if (!empty($errors['email'])): ?><div class="invalid-feedback"><?= $errors['email'] ?></div><?php endif; ?>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label">Mật khẩu</label>
    <input type="password" name="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>">
    <?php if (!empty($errors['password'])): ?><div class="invalid-feedback"><?= $errors['password'] ?></div><?php endif; ?>
  </div>
  <div class="col-12 d-flex gap-2">
    <button class="btn btn-primary" type="submit">Đăng nhập</button>
    <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>?act=dang-ky">Đăng ký</a>
  </div>
</form> 