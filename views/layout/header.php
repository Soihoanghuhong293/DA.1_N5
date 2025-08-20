<?php 
if (!defined('BASE_URL')) { die('No direct access'); }
$cartCount = function_exists('Cart::countItems') ? 0 : 0; // placeholder
if (class_exists('Cart')) { $cartCount = Cart::countItems(); }
?><!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baby Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card img{object-fit:cover;height:200px;width:100%;}
        .line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>">Baby Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">Trang chủ</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>?act=danh-muc">Danh mục</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <!-- Danh mục chỉ hiển thị trong trang Danh mục -->
        <a href="<?= BASE_URL ?>?act=gio-hang" class="btn btn-sm btn-outline-secondary position-relative">
          Giỏ hàng
          <?php if (!empty($cartCount)): ?>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= (int)$cartCount ?></span>
          <?php endif; ?>
        </a>
        <div class="vr d-none d-lg-block"></div>
        <?php if (!empty($_SESSION['user'])): ?>
          <?php if (!empty($_SESSION['user']['chuc_vu_id']) && (int)$_SESSION['user']['chuc_vu_id'] === 1): ?>
            <a class="btn btn-sm btn-warning" href="<?= BASE_URL_ADMIN ?>">Admin</a>
          <?php endif; ?>
          <span class="small">Xin chào, <?= htmlspecialchars($_SESSION['user']['ho_ten'] ?: $_SESSION['user']['email']) ?></span>
          <a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>?act=dang-xuat">Đăng xuất</a>
        <?php else: ?>
          <a class="btn btn-sm btn-outline-primary" href="<?= BASE_URL ?>?act=dang-nhap">Đăng nhập</a>
          <a class="btn btn-sm btn-primary" href="<?= BASE_URL ?>?act=dang-ky">Đăng ký</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<div class="container my-4"> 