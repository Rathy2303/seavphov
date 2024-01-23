<?php

error_reporting(0);

 

$msg = "";

$db=mysqli_connect('sql308.infinityfree.com','if0_35029592','thy23032003','if0_35029592_ebook') or die("Database is not connect !");

// If upload button is clicked ...

if (isset($_POST['addpost'])) {

    $ptitle=mysqli_real_escape_string($db,$_POST['title']);

    $bookurl=mysqli_real_escape_string($db,$_POST['bookurl']);

    $cid=$_POST['booktype'];

    $folder = "../images/book/".basename($_FILES["imagefile"]["name"]);

    $filename = $_FILES["imagefile"]["name"];

    // Get all the submitted data from the form

    $sql = "INSERT INTO book (title, image,book_url,category_id) VALUES ('$ptitle','$filename','$bookurl','$cid')";

    // Execute query

    mysqli_query($db, $sql);

    // Now let's move the uploaded image into the folder: image

    if (move_uploaded_file($_FILES["imagefile"]["tmp_name"], $folder)) {

        echo "<h3>  Image uploaded successfully!</h3>";

    } else {

        echo "<h3>  Failed to upload image!</h3>";

    }
    header("Location:../admin/index.php");

}
?>