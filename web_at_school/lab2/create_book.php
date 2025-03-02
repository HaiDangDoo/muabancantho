
<?php
$image_fieldname = "image_file";
    //biến $image_fieldname == với khóa image_file
        isset($_FILES[$image_fieldname]) or die("No data to insert into bookstore database");
        /*
        $_FILES[$image_fieldname] kiểm tra xem tệp có được tải lên không.
        Nếu không có dữ liệu, dừng chương trình và hiển thị thông báo: "No data to insert into bookstore database".
        */
        $imgFile = $_FILES[$image_fieldname];
        //Lưu trữ thông tin của tệp tải lên vào biến $imgFile
        require_once("../mysqlConnect.php");
        //nhúng tệp chứa kết nối đến MySQL($mysysqli).
        $mysqli->select_db("bookstore");
        //chọn cơ sở dữ liệu.
        check_upload_img_file($imgFile);
        //kiểm tra xem tệp có hợp lệ hay không
        if(isset($_POST["title"]) && isset($_POST["introduction"])) { 
            //check xem người dùng đã nhập tiêu đề và giới thiệu chưa
            insert_book($_POST["title"], $_POST["introduction"], $mysqli);
            //nếu có, gọi hàm insert_book() để thêm vào csdl
        }else{
            echo "Books information is required";
            exit();
            //nếu thông tin không đủ in ra "..." và kêts thúc chương trình.
        }
        
        insert_image_to_db($imgFile, $mysqli);
        //gọi hàm để lưu ảnh vào csdlcsdl
        
        function insert_book($title, $intro, $mysqli){
            //tạo hàm để chèn sách vào cdsl 
            //$mysqli là đối tượng kết nối csdl được khởi tạo trong mysysqlConnect.php 
            $stm = $mysqli->prepare("INSERT INTO books (title, introduction) values(?,?)");
            //$mysqli->prepare(...) giúp tạo một câu lệnh SQL động. chuẩn bị truy vấn trước khi thực thi
            //Nó giúp bảo vệ chống lại SQL Injection và tối ưu hóa hiệu suất.

            $stm->bind_param("ss", $title, $intro);
            //bind_param("ss", $title, $intro): Gán dữ liệu vào câu lệnh SQL (ss có nghĩa là 2 chuỗi string).
            if($stm->execute()) {
            echo "The book was inserted! with id=".$mysqli->insert_id;
            }else{
            echo "Error: ".$stm->error;
            }
            /*
            Nếu chèn thành công, hiển thị ID của sách vừa thêm ($mysqli->insert_id).
            Nếu lỗi, hiển thị lỗi SQL. */
            $stm->close();
            }
        function check_upload_img_file($imgFile) {
            //Kiểm tra xem tệp có hợp lệ không trước khi đưa vào CSDL
            $php_errors = array (UPLOAD_ERR_INI_SIZE=>'Maximum file size in php.ini exceeded',
                                UPLOAD_ERR_FORM_SIZE=>'Maximum file size in HTML form exceeded',
                                UPLOAD_ERR_PARTIAL=> 'Only part of the file was uploaded',
                                UPLOAD_ERR_NO_FILE=> 'No image file selected for the book');
            ($imgFile['error']==0) or die("the server couldn't upload the image you selected due to: "
                                            .$php_errors [$imgFile['error']]);
            //Nếu $imgFile['error'] == 0 (tức là không có lỗi), chương trình tiếp tục.
            //Nếu có lỗi, nó sẽ dừng chương trình (die()) và hiển thị thông báo lỗi tương ứng.
            $imgFileTmpName = $imgFile['tmp_name'];
            //lấy đường dẫn tạm thời
            $image_data = file_get_contents($imgFileTmpName);
            //đọc nội dung của tệp ảnh, điều này cần thiết nêú bạn muốn lưu ảnh vào CSDL dưới dạng BLOB
            is_uploaded_file($imgFileTmpName) or die("Possible file upload attack: ".$imgFileTmpName);
            //kiểm tra xem tệp có thực sự được tải từ người dùng không, nếu không có ai đó đang cố tấn công bằng cách đưa đưòng dẫn giả mạo
            //VD: $imgFile['tmp_name'] = "/etc/passwd"
            getimagesize($imgFileTmpName) or die("The selected file is not an image file: ".$imgFileTmpName);
        }
            //Kiểm tra xem có phải là hình ảnh hợp lệ không
        function insert_image_to_db($imgFile, $mysqli) {
            //chèn ảnh vào csdl
            $image_data = file_get_contents($imgFile['tmp_name']) or die("File doesn't exist: ".$imgFile['tmp_name']); 
            //lấy dữ liêu hình ảnh.
            $book_id = $mysqli->insert_id;
            // Lấy ID của sách vừa được thêm vào bảng books
            
            $stm = $mysqli->prepare("INSERT INTO images (book_id, filename, mine_type, file_size, image_data)". "VALUES(?,?,?,?,?)");
            //chuẩn bị dữ liệu trước khi truy vấn
//             ? là placeholder, đại diện cho dữ liệu nhưng không bị nhúng trực tiếp vào SQL.
//              Khi bind_param() gán giá trị, MySQL hiểu đây là một giá trị độc lập, không phải một phần của truy vấn SQL.
//              Nếu hacker nhập ' OR '1'='1, nó chỉ được coi là một chuỗi văn bản thuần túy, không thể thay đổi logic truy vấn.
//              => Kết quả: Không thể bị SQL Injection.
            if (!$stm) {
                
                die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
            }
            
            $stm->bind_param("issis", $book_id, $imgFile["name"], $imgFile['type'], $imgFile['size'], $image_data); 
            //gán gía trị vào truy vấn.
            if($stm->execute()) {
                echo "<br/>The book's image was inserted!";
            } else {
                echo "Error: ".$stm->error;
            }
            //nếu thành công hiển thị "..." nếu thất bại hiên thị lỗi
            $stm->close();
        }
    ?> 