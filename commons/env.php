<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS
define('BASE_URL', 'http://localhost/DuAN1/');
define('BASE_URL_ADMIN', 'http://localhost/DuAN1/admin/');


//define('BASE_URL'       , 'http://localhost:8001/');

// Đường dẫn vào phần admin
//define('BASE_URL_ADMIN'       , 'http://localhost:8001/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'phoneweb');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');
