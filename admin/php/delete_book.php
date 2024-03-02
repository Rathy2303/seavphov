<?php
        include '../../include/dbuser.php';
        // Get Pass Data From AJAX
        $id = $_POST['id'];
        $image = $_POST['img'];
        $path = '../../images/book/'. $image;
        if(unlink($path)){
            // Update To Database
            try {
                $delete = $db->prepare("DELETE FROM book WHERE id=?");
                $delete->execute([$id]);
            } catch (Exception $e) {
               echo $e->getMessage();
            }
            echo "Delete Successfull";
        }
        
?>