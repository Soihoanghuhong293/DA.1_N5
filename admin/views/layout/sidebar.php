  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #5B4B8A; color: white;">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="./assets/dist//img/tải xuống.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">LUCK5</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./assets/dist//img/avatar2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">BABY STORE</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2" style="background-color: #7C6AAE; color: white;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN .'?act=danh-muc' ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh mục sản phẩm
              </p>
            </a>
          </li>   


           <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN .'?act=san-pham' ?>" class="nav-link">
              <i class="nav-icon fas fa-baby"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN .'?act=tai-khoan' ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Quản lý người dùng
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN .'?act=khach-hang' ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Khách hàng
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN .'?act=don-hang' ?>" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Đơn hàng
              </p>
            </a>
          </li>   
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>