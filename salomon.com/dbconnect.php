<?php
$conn = mysqli_connect('localhost', 'root', '', 'salomon')
    or ('lỗi!!!');

$conn->query("SET NAMES 'utf8mb4'");
$conn->query("SET CHARACTER SET UTF8MB4");
$conn->query("SET SESSION collation_connection = 'tuf8mb4_unicode_ci'");
