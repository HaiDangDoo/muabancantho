<?php
$tk = $_POST['txtTaiKhoan'];
$mk = $_POST['txtMatKhau'];


// in ra màng hình
echo "Tài khoản là: " . $tk . "<br>";
echo "Mật khẩu là: " . $mk . "<br>";

// kiểm tra đăng nhập
if ($tk == 'admin' && $mk == "123") {
    echo "Đăng nhập thành công!!!";
} else {
    echo "Đăng nhập thất bại!!!";
}
