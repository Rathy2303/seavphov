<?php
    if(isset($_POST['add'])){
        include '../../include/dbuser.php';
        // Get Pass Data From AJAX
        $title = $_POST['book_title'];
        $type = $_POST['book_type_selected'];
        $url = $_POST['book_url'];
        $img_data = file_get_contents($_FILES['image']['tmp_name']);
        $img_name = $_FILES['image']['name'];
        // Update To Database
        $stmp = $db->prepare("INSERT INTO book (id,title,image,book_url,category_id,view,download) VALUES('',?,?,?,?,0,0)");
        $stmp->execute([$title,$img_name,$url,$type]);
        header("location: ../index.php");
        $folder = "../../images/book/" . basename($img_name);
        // Execute query
        if($img_name != ""){
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
                header("location: ../index.php");
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
        }else
            header("location: ../post.php");
        
    }
?>