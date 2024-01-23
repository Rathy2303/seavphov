<?php
    if(isset($_POST['save'])){
        include '../../include/dbuser.php';
        // Get Pass Data From AJAX
        $id = $_POST['book_id'];
        $title = $_POST['book_title'];
        $type = $_POST['book_type_selected'];
        $url = $_POST['book_url'];
        $img = $_FILES['image']['name'];
    
        // Update To Database
        $getImage = mysqli_query($db, "SELECT * FROM book WHERE id=$id");
        $row = mysqli_fetch_assoc($getImage);
        $path = '../../images/book/' . $row['image'];
        $folder = "../../images/book/" . basename($img);
        $sql = "";
        if ($img == "") {
            // No file was selected for upload, your (re)action goes here
            $sql = "UPDATE book SET title='$title',book_url='$url',category_id='$type' WHERE id='$id'";
        } else {
            $sql = "UPDATE book SET title='$title',image='$img',book_url='$url',category_id='$type' WHERE id='$id'";
            @unlink($path);
        }
        mysqli_query($db, $sql);
        // Execute query
        if($img != ""){
           
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
                header("location: ../index.php");
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
        }else
            header("location: ../index.php");
        
    }
?>