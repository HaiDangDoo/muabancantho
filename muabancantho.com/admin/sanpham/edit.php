<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản phẩm</title>
    <?php
    include_once __DIR__ . '/../layouts/styles.php';
    ?>
</head>
<body>
    <div class="container-fluid">
        <!-- dòng header START -->
        <div class="row">
            <div class="col-12">
                <?php
                include_once __DIR__ . '/../layouts/header.php';
                ?>
            </div>
        </div>
        <!-- dòng header END -->
        <!-- dòng SIDEBAR & CONTENT START -->
        <div class="row">
            <div class="col-4">
                <?php
                include_once __DIR__ . '/../layouts/sidebar.php';
                ?>
            </div>
            <div class="col-8">
                <h1>Sửa Sản phẩm</h1>
                <?php
                // 1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                // ----- Tìm lại dữ liệu cũ --------
                // 2. Chuẩn bị câu lệnh
                $sp_ma = $_GET['sp_ma'];
                $sqlSelectDuLieuCu = "SELECT *
                                    FROM sanpham
                                    WHERE sp_ma = $sp_ma;";
                // 3. Thực thi
                $resultDuLieuCu = mysqli_query($conn, $sqlSelectDuLieuCu);
                // 4. Phân tách thành mảng array trong PHP
                $rowSanPhamCu = mysqli_fetch_array($resultDuLieuCu, MYSQLI_ASSOC);







                // ----- Dữ liệu Loại sản phẩm -------
                // 2. Chuẩn bị câu lệnh
                $sqlSelectLoaiSanPham = "SELECT *
                                        FROM loaisanpham;";
                // 3. Thực thi
                $resultLoaiSanPham = mysqli_query($conn, $sqlSelectLoaiSanPham);
                // 4. Phân tách thành mảng array trong PHP
                $arrDanhSachLoaiSanPham = [];
                while($row = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
                    $arrDanhSachLoaiSanPham[] = array(
                        'lsp_ma' => $row['lsp_ma'],
                        'lsp_ten' => $row['lsp_ten']
                    );
                }
                // ----- Dữ liệu Nhà sản xuất ---------
                // 2. Chuẩn bị câu lệnh
                $sqlSelectNhaSanXuat = "SELECT *
                                        FROM nhasanxuat;";
                // 3. Thực thi
                $resultNhaSanXuat = mysqli_query($conn, $sqlSelectNhaSanXuat);
                // 4. Phân tách thành mảng array trong PHP
                $arrDanhSachNhaSanXuat = [];
                while($row = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
                    $arrDanhSachNhaSanXuat[] = array(
                        'nsx_ma' => $row['nsx_ma'],
                        'nsx_ten' => $row['nsx_ten'],
                    );
                }
                // ----- Dữ liệu Khuyến mãi ---------
                // 2. Chuẩn bị câu lệnh
                $sqlSelectKhuyenMai = "SELECT *
                                        FROM khuyenmai;";
                // 3. Thực thi
                $resultKhuyenMai = mysqli_query($conn, $sqlSelectKhuyenMai);
                // 4. Phân tách thành mảng array trong PHP
                $arrDanhSachKhuyenMai = [];
                while($row = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
                    $arrDanhSachKhuyenMai[] = array(
                        'km_ma' => $row['km_ma'],
                        'km_ten' => $row['km_ten'],
                        'km_noidung' => $row['km_noidung'],
                        'km_tungay' => $row['km_tungay'],
                        'km_denngay' => $row['km_denngay'],
                    );
                }
                ?>
                <form name="frmCreate" method="post" action="">
                    <div>
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="sp_ten" class="form-control"
                            value="<?= $rowSanPhamCu['sp_ten'] ?>" />
                    </div>
                    <div>
                        <label class="form-label">Giá sản phẩm</label>
                        <input type="number" name="sp_gia" class="form-control"
                            value="<?= $rowSanPhamCu['sp_gia'] ?>" />
                    </div>
                    <div>
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea id="sp_mota_ngan" name="sp_mota_ngan" class="form-control"><?= $rowSanPhamCu['sp_mota_ngan'] ?></textarea>
                    </div>
                    <div>
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea id="sp_mota_chitiet" name="sp_mota_chitiet" class="form-control"><?= $rowSanPhamCu['sp_mota_chitiet'] ?></textarea>
                    </div>
                    <div>
                        <label class="form-label">Số lượng</label>
                        <input type="number" name="sp_soluong" class="form-control" value="<?= $rowSanPhamCu['sp_soluong'] ?>" />
                    </div>
                    <div>
                        <label>Loại sản phẩm</label>
                        <select name="lsp_ma" class="form-control">
                            <?php foreach($arrDanhSachLoaiSanPham as $lsp): ?>
                                <option value="<?= $lsp['lsp_ma'] ?>" <?php echo ($lsp['lsp_ma'] == $rowSanPhamCu['lsp_ma'] ? 'selected' : '') ?>><?= $lsp['lsp_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>Nhà sản xuất</label>
                        <select name="nsx_ma" class="form-control">
                            <?php foreach($arrDanhSachNhaSanXuat as $nsx): ?>
                                <option value="<?= $nsx['nsx_ma'] ?>" <?php echo ($nsx['nsx_ma'] == $rowSanPhamCu['nsx_ma'] ? 'selected' : '') ?>><?= $nsx['nsx_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>Khuyến mãi</label>
                        <select name="km_ma" class="form-control">
                            <option value="">Mời chọn khuyến mãi</option>
                            <?php foreach($arrDanhSachKhuyenMai as $km): ?>
                                <option value="<?= $km['km_ma'] ?>" <?php echo($km['km_ma'] == $rowSanPhamCu['km_ma'] ? 'selected' : '') ?>><?= $km['km_noidung'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <a href="index.php" class="btn btn-outline-secondary">Quay về danh sách</a>
                        <button class="btn btn-primary" name="btnSave">Lưu</button>
                    </div>
                </form>
                <?php
                // Nếu người dùng bấm Lưu -> xử lý
                if(isset($_POST['btnSave'])) {
                    // 1. Thu thập thông tin người dùng
                    $sp_ten = $_POST['sp_ten'];
                    $sp_gia = $_POST['sp_gia'];
                    $sp_mota_ngan = $_POST['sp_mota_ngan'];
                    $sp_mota_chitiet = $_POST['sp_mota_chitiet'];
                    $sp_soluong = $_POST['sp_soluong'];
                    $lsp_ma = $_POST['lsp_ma'];
                    $nsx_ma = $_POST['nsx_ma'];
                    $km_ma = empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma'];
                    $sp_ngaycapnhat = date('Y-m-d H:i:s'); // ngày hiện tại của PHP
                    // 2. Chuẩn bị câu lệnh
                    $sqlUpdateSanPham = "UPDATE sanpham
                        SET
                            sp_ten='$sp_ten',
                            sp_giacu=sp_gia,
                            sp_gia=$sp_gia,
                            sp_mota_ngan='$sp_mota_ngan',
                            sp_mota_chitiet='$sp_mota_chitiet',
                            sp_ngaycapnhat=NOW(),
                            sp_soluong=$sp_soluong,
                            lsp_ma=$lsp_ma,
                            nsx_ma=$nsx_ma,
                            km_ma=$km_ma
                        WHERE sp_ma=$sp_ma;";
                    // var_dump($sqlUpdateSanPham);
                    // 3. Thực thi
                    mysqli_query($conn, $sqlUpdateSanPham);
                    // 4. Xong, điều hướng vể trang danh sách
                    // 4.1. Lưu câu thông báo trong session
                    $_SESSION['flash_msg'] = "Đã sửa sản phẩm <b>[$sp_ten]</b> thành công!";
                    $_SESSION['flash_context'] = 'success';
                    echo '<script>location.href = "index.php"</script>';
                }
                ?>
            </div>
        </div>
        <!-- dòng SIDEBAR & CONTENT END -->
        <!-- dòng FOOTER START -->
         <div class="row">
            <div class="col-12">
                <?php
                include_once __DIR__ . '/../layouts/footer.php';
                ?>
            </div>
         </div>
        <!-- dòng FOOTER END -->
    </div>

    <?php
    include_once __DIR__ . '/../layouts/scripts.php';
    ?>
    <script>
      tinymce.init({
        selector: '#sp_mota_ngan',
        license_key: 'gpl' // giấy phép mã nguồn mở
      });

      tinymce.init({
        selector: '#sp_mota_chitiet',
        license_key: 'gpl' // giấy phép mã nguồn mở
      });
    </script>
</body>
</html>