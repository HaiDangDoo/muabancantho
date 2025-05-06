<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sản phẩm</title>
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
                <h1>Danh sách Sản phẩm</h1>
				<!-- In giao diện câu thông báo -->
				<?php if(isset($_SESSION['flash_msg'])): ?>
					<div class="alert alert-<?= $_SESSION['flash_context'] ?>" role="alert">
						<?= $_SESSION['flash_msg'] ?>
					</div>
					<?php unset($_SESSION['flash_msg']); ?>
				<?php endif; ?>

                <?php
                // 1. Mở kết nối
                include_once __DIR__ . '/../../dbconnect.php';
                // -------------------- LẤY DỮ LIỆU SẢN PHẨM -------------
                // 2. Chuẩn bị câu lệnh
                $sqlSelectSanPham = "SELECT sp.*
                                    , lsp.lsp_ten
                                    , nsx.nsx_ten
                                    , km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
                                FROM sanpham sp
                                JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma
                                JOIN nhasanxuat nsx ON sp.nsx_ma = nsx.nsx_ma
                                LEFT JOIN khuyenmai km ON sp.km_ma = km.km_ma;";
                // 3. Thực thi
                $resultSanPham = mysqli_query($conn, $sqlSelectSanPham);
                // 4. Phân tích thành mảng array PHP
                $arrDanhSachSanPham = [];
                while($row = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                    $arrDanhSachSanPham[] = array(
                        'sp_ma' => $row['sp_ma'],
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => $row['sp_gia'],
                        'sp_giacu' => $row['sp_giacu'],
                        'sp_soluong' => $row['sp_soluong'],
                        'lsp_ma' => $row['lsp_ma'],
                        'lsp_ten' => $row['lsp_ten'],
                        'nsx_ma' => $row['nsx_ma'],
                        'nsx_ten' => $row['nsx_ten'],
                        'km_ma' => $row['km_ma'],
                        'km_ten' => $row['km_ten'],
                        'km_noidung' => $row['km_noidung'],
                        'km_tungay' => $row['km_tungay'],
                        'km_denngay' => $row['km_denngay'],
                    );
                }
                // var_dump($arrDanhSachSanPham);
                // ----------- LẤY DỮ LIỆU HÌNH SẢN PHẨM --------------
                // 2. Chuẩn bị câu lệnh
                $sqlSelectHinhSanPham = "SELECT *
                                        FROM hinhsanpham;";
                // 3. Thực thi
                $resultHinhSanPham = mysqli_query($conn, $sqlSelectHinhSanPham);
                // 4. Phân tích thành mảng array PHP
                $arrDanhSachHinhSanPham = [];
                while($row = mysqli_fetch_array($resultHinhSanPham, MYSQLI_ASSOC)) {
                    $arrDanhSachHinhSanPham[$row['sp_ma']][] = array(
                        'hsp_ma' => $row['hsp_ma'],
                        'hsp_tentaptin' => $row['hsp_tentaptin'],
                        'sp_ma' => $row['sp_ma'],
                    );
                }
                // var_dump($arrDanhSachHinhSanPham);
                ?>

                <a href="create.php" class="btn btn-primary">
					Thêm mới
					<i class="fa-solid fa-plus"></i>
				</a>
                <table class="table table-bordered">
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Hành động</th>
                    </tr>
                    <?php foreach($arrDanhSachSanPham as $sp): ?>
                        <tr>
                            <td><?= $sp['sp_ma'] ?></td>
                            <td>
                                <?php if(!empty($sp['km_ten'])): ?>
                                    <div class="border bg-warning-subtle">
                                        <?= $sp['km_ten'] ?> (<?= $sp['km_noidung'] ?>)<br />
                                        <?= date('m/d/y', strtotime($sp['km_tungay'])) ?> ~ <?= date('m/d/Y', strtotime($sp['km_denngay'])) ?>
                                    </div>
                                <?php endif; ?>

                                <h5><?= $sp['sp_ten'] ?></h5>
                                <span class="badge text-bg-primary"><?= $sp['lsp_ten'] ?></span><br />
                                <span><?= $sp['nsx_ten'] ?></span>

                                <?php if(isset($arrDanhSachHinhSanPham[$sp['sp_ma']])): ?>
                                    <!-- Danh sách hình sản phẩm START -->
                                    <div>
                                        <?php foreach($arrDanhSachHinhSanPham[$sp['sp_ma']] as $hsp): ?>
                                            <?= $hsp['hsp_tentaptin'] ?>
                                            <img src="/muabancantho.com/uploads/<?= $hsp['hsp_tentaptin'] ?>" 
                                            style="width: 80px;"/>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Danh sách hình sản phẩm END -->
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;">
                                <b><?= number_format($sp['sp_gia'], 0, '.', ',') ?></b><br />
                                <?php if($sp['sp_giacu'] > 0): ?>
                                    <del class="text-body-secondary fs-6"><?= number_format($sp['sp_giacu'], 0, '.', ',') ?></del>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;"><?= number_format($sp['sp_soluong'], 0, '.', ',') ?></td>
                            <td>
                                <a href="edit.php?sp_ma=<?= $sp['sp_ma'] ?>" class="btn btn-warning">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <a href="javascript:void(0)" data-sp_ma="<?= $sp['sp_ma'] ?>" class="btn btn-danger btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
        // Đợi trình duyệt render xong -> mới thực thi JS
        $(function() {
            // Nhờ JQUERY tìm cái gì đó -> yêu cầu làm gì đó
            // Nhờ JQUERY tìm các elements đang sử dụng class .btn-delete
            // => yêu cầu đăng ký sự kiện CLICK
            $('.btn-delete').on('click', function() {
                // lấy dữ liệu từ thuộc tính của phần tử đang click
                var sp_ma = $(this).attr('data-sp_ma');
                // hiển thị cảnh báo
                //confirm('Bạn có chắc chắn muốn xóa hay không?');
                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa hay không?",
                    text: "Một khi xóa thì không thể phục hồi !!!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#cf0d14",
                    cancelButtonColor: "#c3c3c3",
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Bỏ qua"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // điều hướng qua trang delete.php
                        location.href = "delete.php?sp_ma=" + sp_ma;
                    }
                });
            });
        });
    </script>
</body>
</html>