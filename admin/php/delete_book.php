<?php
        include '../../include/dbuser.php';
        // Get Pass Data From AJAX
        $id = $_POST['id'];
        $image = $_POST['img'];
        $path = '../../images/book/'. $image;
        if(unlink($path)){
            // Update To Database
            mysqli_query($db, "DELETE FROM book WHERE id=$id");
            echo "Delete Successfull";
        }
        
?>