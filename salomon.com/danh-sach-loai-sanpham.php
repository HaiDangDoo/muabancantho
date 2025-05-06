<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sach loai san pham</title>
</head>

<body>
    <h1>Danh sach loai san pham</h1>


    <?php
    include_once __DIR__ . '/dbconnect.php';

    $sql = "SELECT * FROM loaisanpham;";


    $data = mysqli_query($conn, $sql);

    $arrDanhSachLSP = [];
    while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
        $arrDanhSachLSP[] = array(
            'lsp_ma' => $row['lsp_ma'],
            'lsp_ten' => $row['lsp_ten'],
            'lsp_mota' => $row['lsp_mota'],
        );
    }
    // var_dump($arrDanhSachLSP);

    ?>
    <table border="1">
        <tr>
            <th>MÃ LSP</th>
            <th>TÊN LSP</th>
            <th>MÔ TẢ LSP</th>
        </tr>
        <?php foreach ($arrDanhSachLSP as $lsp): ?>
            <tr>
                <td><?php echo $lsp['lsp_ma']; ?></td>
                <td><?php echo $lsp['lsp_ten']; ?></td>
                <td><?php echo $lsp['lsp_mota']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


</body>

</html>