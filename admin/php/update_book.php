<?php
    if(isset($_POST['save'])){
        include '../../include/dbuser.php';
        // Get Pass Data From AJAX
        $id = $_POST['book_id'];
        $title = $_POST['book_title'];
        $type = $_POST['book_type_selected'];
        $url = $_POST['book_url'];
        $imgData = $_FILES['image']['tmp_name'];
        $img=$_FILES['image']['name'];
        $path = "../../images/book/";
        $path_file = $path . basename($img);
    
        // Update To Database
        if(move_uploaded_file($imgData,$path_file)){
            $stmp = $db->prepare("UPDATE book SET title=?,image=?,book_url=?,category_id=? WHERE id=?");
            $stmp->bind_param("sssii",$title,$img,$url,$type,$id);
            $stmp->execute();
            $stmp->close();
            header("location: ../post.php");
        }
        // if ($img == "") {
        //     // No file was selected for upload, your (re)action goes here
        //     $stmp = $db->prepare("UPDATE book SET title=?,book_url=?,category_id=? WHERE id=?");
        //     $stmp->bind_param("ssii",$title,$url,$type,$id);
        //     $stmp->execute();
        //     $stmp->close();
        // } else {
        //     $stmp = $db->prepare("UPDATE book SET title=?,image=?,book_url=?,category_id=? WHERE id=?");
        //     $stmp->bind_param("sssii",$title,$imgData,$url,$type,$id);
        //     $stmp->execute();
        //     $stmp->close();
        // }
           
        
    }
?>