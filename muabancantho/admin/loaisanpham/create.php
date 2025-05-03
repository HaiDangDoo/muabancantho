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

                <a href="index.php" class="btn btn-outline-secondary">Quay về danh sách</a>
                <button class="btn btn-primary">Lưu</button>
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