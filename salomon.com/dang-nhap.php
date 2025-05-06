<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>

<body>
    <fieldset>
        <legend>
            <h1>Đăng Nhập</h1>
        </legend>
        <form name="frmDangNhap" method="POST" action="xu-ly-dang-nhap.php">
            <label for="taikhoan">Tài Khoản</label>
            <input type="text" name="txtTaiKhoan" id="txtTaikhoan">
            <br>
            <label for="matkhau">Mật Khẩu</label>
            <input type="password" name="txtMatKhau" id="txtMatkhau">
            <br>
            <button type="submit">Đăng Nhập</button>


        </form>
    </fieldset>
</body>

</html>