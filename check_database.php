<?php
// File kiểm tra database
require_once './commons/env.php';
require_once './commons/function.php';

echo "<h1>Kiểm tra Database</h1>";

try {
    $conn = connectDB();
    echo "<h2>✅ Kết nối database thành công!</h2>";
    
    // Kiểm tra bảng danh_mucs
    $stmt = $conn->query("SELECT COUNT(*) as count FROM danh_mucs");
    $result = $stmt->fetch();
    echo "<h3>📊 Bảng danh_mucs:</h3>";
    echo "Số lượng danh mục: <strong>" . $result['count'] . "</strong><br>";
    
    if ($result['count'] > 0) {
        $stmt = $conn->query("SELECT * FROM danh_mucs LIMIT 5");
        $danh_mucs = $stmt->fetchAll();
        echo "<ul>";
        foreach ($danh_mucs as $dm) {
            echo "<li>ID: {$dm['id']} - Tên: {$dm['ten_danh_muc']}</li>";
        }
        echo "</ul>";
    } else {
        echo "❌ Không có danh mục nào trong database<br>";
    }
    
    // Kiểm tra bảng san_phams
    $stmt = $conn->query("SELECT COUNT(*) as count FROM san_phams");
    $result = $stmt->fetch();
    echo "<h3>📦 Bảng san_phams:</h3>";
    echo "Số lượng sản phẩm: <strong>" . $result['count'] . "</strong><br>";
    
    if ($result['count'] > 0) {
        $stmt = $conn->query("SELECT san_phams.*, danh_mucs.ten_danh_muc 
                             FROM san_phams 
                             INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id 
                             LIMIT 5");
        $san_phams = $stmt->fetchAll();
        echo "<ul>";
        foreach ($san_phams as $sp) {
            echo "<li>ID: {$sp['id']} - Tên: {$sp['ten_san_pham']} - Danh mục: {$sp['ten_danh_muc']}</li>";
        }
        echo "</ul>";
    } else {
        echo "❌ Không có sản phẩm nào trong database<br>";
    }
    
    // Kiểm tra cấu trúc bảng
    echo "<h3>🔧 Cấu trúc bảng san_phams:</h3>";
    $stmt = $conn->query("DESCRIBE san_phams");
    $columns = $stmt->fetchAll();
    echo "<ul>";
    foreach ($columns as $col) {
        echo "<li>{$col['Field']} - {$col['Type']} - Default: {$col['Default']}</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<h2>❌ Lỗi kết nối database:</h2>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    echo "<h3>Kiểm tra cấu hình:</h3>";
    echo "<ul>";
    echo "<li>Database name: " . DB_NAME . "</li>";
    echo "<li>Host: " . DB_HOST . "</li>";
    echo "<li>Username: " . DB_USERNAME . "</li>";
    echo "</ul>";
}
?> 