<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}


//thêm file
function uploadFile($file, $folderUpload) {
    $folder = rtrim($folderUpload, "/\\") . "/";
    $originalName = basename($file['name']);
    $safeName = preg_replace('/[^A-Za-z0-9._-]/', '-', $originalName);
    // Bỏ tiền tố 'uploads' nếu vô tình dính trong tên file
    $safeName = preg_replace('/^uploads[-_]?/i', '', $safeName);

    $from = $file['tmp_name'];

    // Chống trùng: so sánh hash với mọi file trong thư mục
    $absFolder = PATH_ROOT . $folder;
    if (is_dir($absFolder)) {
        $hash = @sha1_file($from);
        if ($hash) {
            foreach (glob($absFolder . '*') as $existing) {
                if (is_file($existing) && @sha1_file($existing) === $hash) {
                    return str_replace(PATH_ROOT, '', $existing);
                }
            }
        }
    }

    $pathStorage = $folder . time() . '-' . $safeName;
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }  
    return null;
}
//xoá file
function deleteFile($file) {
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}
// Xoá session sau khi load trang
function deleteSessionError() {
    if (isset($_SESSION['flash'])) {
        // Huỷ session sau khi đã tải trang
        unset($_SESSION['flash']);
        session_unset();
        session_destroy();
    }
}
// upload  = update ablum ảnh
function uploadFileAlbum($file, $folderUpload , $key) {
    $folder = rtrim($folderUpload, "/\\") . "/";
    $originalName = basename($file['name'][$key]);
    $safeName = preg_replace('/[^A-Za-z0-9._-]/', '-', $originalName);
    // Bỏ tiền tố 'uploads' nếu vô tình dính trong tên file
    $safeName = preg_replace('/^uploads[-_]?/i', '', $safeName);

    $from = $file['tmp_name'][$key];

    // Chống trùng: so sánh hash với mọi file trong thư mục
    $absFolder = PATH_ROOT . $folder;
    if (is_dir($absFolder)) {
        $hash = @sha1_file($from);
        if ($hash) {
            foreach (glob($absFolder . '*') as $existing) {
                if (is_file($existing) && @sha1_file($existing) === $hash) {
                    return str_replace(PATH_ROOT, '', $existing);
                }
            }
        }
    }

    $pathStorage = $folder . time() . '-' . $safeName;
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }  
    return null;
}
//debug
