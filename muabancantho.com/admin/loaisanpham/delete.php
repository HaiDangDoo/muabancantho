<?php
session_start();
// 1. Mở kết nối
include_once __DIR__ . '/../../dbconnect.php';
// 2. Chuẩn bị câu lệnh
$lsp_ma = $_GET['lsp_ma'];

$sqlDelete = "DELETE FROM loaisanpham 
                WHERE lsp_ma=$lsp_ma";
// 3. Thực thi câu lệnh
mysqli_query($conn, $sqlDelete);
// 4. Điều hướng
$_SESSION['flash_msg'] = "Đã xóa loại sản phẩm có mã <b>[$lsp_ma]</b> thành công!";
$_SESSION['flash_context'] = 'danger';
echo '<script>location.href = "index.php";</script>';
?>