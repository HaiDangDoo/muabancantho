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
                <h1>Thêm mới loại sản phẩm</h1>

                <form name="frmCreate" method="post" action="">
                    <div class="mb-2">
                        <label>Tên loại sản phẩm</label>
                        <input type="text" name="lsp_ten" list="dulieuLoaisanpham" class="form-control" />
                        <datalist id="dulieuLoaisanpham">
                            <option value="loại A"></option>
                            <option value="loại B"></option>
                            <option value="loại C"></option>
                            <option value="loại D"></option>
                        </datalist>
                    </div>
                    <div class="mb-2">
                        <label>Mô tả loại sản phẩm</label>
                        <textarea name="lsp_mota" class="form-control"></textarea>
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

                    $sqlInsert = "INSERT INTO loaisanpham
                                (lsp_ten, lsp_mota)
                                VALUES ('$lsp_ten', '$lsp_mota');";
                    // 3. Thực thi
                    mysqli_query($conn, $sqlInsert);
                    // 4. Xong, điều hướng vể trang danh sách
                    // 4.1. Lưu câu thông báo trong session
                    $_SESSION['flash_msg'] = "Đã thêm loại sản phẩm <b>[$lsp_ten]</b> thành công!";
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