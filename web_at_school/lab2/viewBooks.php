
<h2>Danh sách sách</h2>
<table border="1">
    <tr>
        <th>Ảnh bìa</th>
        <th>Tiêu đề</th>
        <th>Giới thiệu</th>
    </tr>

    <?php
    require("../mysqlConnect.php");
    $mysqli->select_db("bookstore");

    $search = isset($_GET['search']) ? $_GET['search'] : "";
    $genre = isset($_GET['genre']) ? $_GET['genre'] : "";

    $sql = "SELECT * FROM books WHERE 1";

    if (!empty($search)) {
        $sql .= " AND title LIKE '%" . $mysqli->real_escape_string($search) . "%'";
    }
    if (!empty($genre)) {
        $sql .= " AND genre = '" . $mysqli->real_escape_string($genre) . "'";
    }

    $res = $mysqli->query($sql);

    while ($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='showImage.php?book_id=" . $row['book_id'] . "' width='100' height='150'></td>";
        echo "<td><b>" . $row['title'] . "</b></td>";
        echo "<td>" . $row['introduction'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
