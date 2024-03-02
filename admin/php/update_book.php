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
            try {
                $stmp = $db->prepare("UPDATE book SET title=?,image=?,book_url=?,category_id=? WHERE id=?");
                $stmp->execute([$title,$img,$url,$type,$id]);
                header("location: ../post.php");
            } catch (Exception $e) {
               echo $e->getMessage();
            }
           
        }
    }
?>