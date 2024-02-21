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
        // mysqli_query($db, "INSERT INTO book (id,title,image,book_url,category_id,view,download) VALUES('','$title','$img','$url','$type',0,0)");
        $stmp->bind_param("sssi",$title,$img_data,$url,$type);
        $stmp->execute();
        $stmp->close();
        header("location: ../index.php");
        // $folder = "../../images/book/" . basename($img);
        // // Execute query
        // if($img != ""){
        //     if (move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
        //         echo "<h3>  Image uploaded successfully!</h3>";
        //         header("location: ../index.php");
        //     } else {
        //         echo "<h3>  Failed to upload image!</h3>";
        //     }
        // }else
        //     header("location: ../post.php");
        
    }
?>