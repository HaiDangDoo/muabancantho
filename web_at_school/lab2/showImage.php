<?php
// showImage.php
require_once("../mysqlConnect.php");
$mysqli->select_db("bookstore");
try{
    if(!isset($_REQUEST['book_id'])){
        echo "No image to load was specified.";
        exit();
    } else {
        $book_id = $_REQUEST["book_id"];
        $stm = $mysqli->prepare("SELECT * FROM images WHERE book_id = ?");
        $stm->bind_param("i", $book_id);

        if($stm->execute()) {
            $img = $stm->get_result()->fetch_assoc();
            ob_clean();
            header("Content-type: ".$img['mine_type']);
            header('Content-length: '.$img['file_size']);
            echo $img['image_data'];
        } else {
            echo "Error: ".$stm->error;
        }
    }
} catch(Exception $exception) {
    echo "Ops! Something went wrong loading the image: ".$exception->getMessage();
}
?>
