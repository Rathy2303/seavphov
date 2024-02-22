<?php
    if(isset($_POST['save'])){
        include '../../include/dbuser.php';
        // Get Pass Data From AJAX
        $id = $_POST['book_id'];
        $title = $_POST['book_title'];
        $type = $_POST['book_type_selected'];
        $url = $_POST['book_url'];
        $imgData = file_get_contents($_FILES['image']['tmp_name']);
        $img=$_FILES['image']['name'];
    
        // Update To Database
        $getImage = mysqli_query($db, "SELECT * FROM book WHERE id=$id");
        $row = mysqli_fetch_assoc($getImage);
        if ($img == "") {
            // No file was selected for upload, your (re)action goes here
            $stmp = $db->prepare("UPDATE book SET title=?,book_url=?,category_id=? WHERE id=?");
            $stmp->bind_param("ssii",$title,$url,$type,$id);
            $stmp->execute();
            $stmp->close();
        } else {
            $stmp = $db->prepare("UPDATE book SET title=?,image=?,book_url=?,category_id=? WHERE id=?");
            $stmp->bind_param("sssii",$title,$imgData,$url,$type,$id);
            $stmp->execute();
            $stmp->close();
        }
            header("location: ../post.php");
        
    }
?>