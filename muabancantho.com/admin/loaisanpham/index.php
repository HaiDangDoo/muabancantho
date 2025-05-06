<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách loại sản phẩm</title>
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
                <h1>Danh sách loại sản phẩm</h1>
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
				// 2. Chuẩn bị câu lệnh
				$sqlSelect = "SELECT *
							FROM loaisanpham;";
				// 3. Thực thi câu lệnh
				$data = mysqli_query($conn, $sqlSelect);
				// 4. Phân rã dữ liệu thành mảng array php
				$arrLoaiSanPham = [];
				while($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
					$arrLoaiSanPham[] = array(
						'lsp_ma' => $row['lsp_ma'],
						'lsp_ten' => $row['lsp_ten'],
						'lsp_mota' => $row['lsp_mota'],
					);
				}
				//var_dump($arrLoaiSanPham);
				?>

				<a href="create.php" class="btn btn-primary">
					Thêm mới
					<i class="fa-solid fa-plus"></i>
				</a>
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th>Mã</th>
						<th>Tên</th>
						<th>Mô tả</th>
						<th>Hành động</th>
					</tr>
					<?php foreach($arrLoaiSanPham as $lsp): ?>
					<tr>
						<td><?= $lsp['lsp_ma'] ?></td>
						<td><?= $lsp['lsp_ten'] ?></td>
						<td><?= $lsp['lsp_mota'] ?></td>
						<td>
							<a href="edit.php?lsp_ma=<?= $lsp['lsp_ma'] ?>" class="btn btn-warning">
								<i class="fa-solid fa-pencil"></i>
							</a>
							<a href="delete.php?lsp_ma=<?= $lsp['lsp_ma'] ?>" class="btn btn-danger">
								<i class="fa-solid fa-trash"></i>
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<nav aria-label="Page navigation example">
				  <ul class="pagination">
					<li class="page-item">
					  <a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					  </a>
					</li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item">
					  <a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					  </a>
					</li>
				  </ul>
				</nav>
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