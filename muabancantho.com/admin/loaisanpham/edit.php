<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới loại sản phẩm</title>
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
                <h1>Sửa loại sản phẩm</h1>
                <?php
                // 1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                // 2. Chuẩn bị câu lệnh
                $lsp_ma = $_GET['lsp_ma'];
                $sqlSelectDuLieuCu = "SELECT *
                                FROM loaisanpham
                                WHERE lsp_ma = $lsp_ma;";
                // 3. Thực thi câu lệnh
                $dataDuLieuCu = mysqli_query($conn, $sqlSelectDuLieuCu);
                // 4. Phân tích dữ liệu thành mảng PHP
                $rowLoaiSanPhamCu = mysqli_fetch_array($dataDuLieuCu, MYSQLI_ASSOC);
                // var_dump($rowLoaiSanPhamCu);
                ?>
                <form name="frmCreate" method="post" action="">
                    <div class="mb-2">
                        <label>Tên loại sản phẩm</label>
                        <input type="text" name="lsp_ten" 
                            value="<?= $rowLoaiSanPhamCu['lsp_ten'] ?>"
                            list="dulieuLoaisanpham" class="form-control" />
                        <datalist id="dulieuLoaisanpham">
                            <option value="loại A"></option>
                            <option value="loại B"></option>
                            <option value="loại C"></option>
                            <option value="loại D"></option>
                        </datalist>
                    </div>
                    <div class="mb-2">
                        <label>Mô tả loại sản phẩm</label>
                        <textarea name="lsp_mota" class="form-control"><?= $rowLoaiSanPhamCu['lsp_mota'] ?></textarea>
                    </div>
                    <a href="index.php" class="btn btn-outline-secondary">Quay về danh sách</a>
                    <button class="btn btn-primary" name="btnSave">Lưu</button>
                </form>
                <?php
                // Người dùng đã bấm nút Save
                if(isset( $_POST['btnSave'] )) {
                    // 1. Mở kết nối
                    include_once __DIR__ . '/../../dbconnect.php';
                    // 2. Chuẩn bị câu lệnh
                    $lsp_ten = $_POST['lsp_ten'];
                    $lsp_mota = $_POST['lsp_mota'];

                    $sqlUpdate = "UPDATE loaisanpham
                            SET lsp_ten = '$lsp_ten',
                                lsp_mota = '$lsp_mota'
                            WHERE lsp_ma = $lsp_ma;";
                    // 3. Thực thi
                    mysqli_query($conn, $sqlUpdate);
                    // 4. Xong, điều hướng vể trang danh sách
                    // 4.1. Lưu câu thông báo trong session
                    $_SESSION['flash_msg'] = "Đã sửa loại sản phẩm <b>[$lsp_ten]</b> thành công!";
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
</body>
</html>