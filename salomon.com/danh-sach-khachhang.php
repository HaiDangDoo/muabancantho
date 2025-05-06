<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>
</head>

<body>
    <h1>Danh Sách Khách Hàng</h1>


    <?php
    include_once __DIR__ . '/dbconnect.php';

    $sql = "SELECT kh_tendangnhap,kh_ten,kh_diachi
    FROM khachhang;";

    $data = mysqli_query($conn, $sql);

    $arrDanhSachKH = [];
    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $arrDanhSachKH[] = array(
            'kh_tendangnhap' => $row['kh_tendangnhap'],
            'kh_ten' => $row['kh_ten'],
            'kh_diachi' => $row['kh_diachi'],
        );
    }
    ?>
    <ul><?php foreach ($arrDanhSachKH as $kh): ?>
            <li>
                Tên đăng nhâp: <?= $kh['kh_tendangnhap'] ?> -
                Họ tên: <?= $kh['kh_ten'] ?> -
                Địa chỉ: <?= $kh['kh_diachi'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>