<?php
session_start();
// 1. Mở kết nối database
include_once __DIR__ . '/../../dbconnect.php';
// 2. Chuẩn bị câu lệnh
$sp_ma = $_GET['sp_ma'];
$sqlDelete = "DELETE FROM sanpham
            WHERE sp_ma = $sp_ma;";
// 3. Thực thi
mysqli_query($conn, $sqlDelete);
// 4. Điều hướng
$_SESSION['flash_msg'] = "Đã xóa sản phẩm có mã <b>[$sp_ma]</b> thành công!";
$_SESSION['flash_context'] = 'danger';
echo '<script>location.href = "index.php";</script>';
?>