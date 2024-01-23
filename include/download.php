<?php
require ('db.php');
$post_id = $_GET['id'];
mysqli_query($db, "UPDATE book SET download=download+1 WHERE id=$post_id");

$postQuery = "SELECT * FROM book WHERE id=$post_id";
$runPQ = mysqli_query($db, $postQuery);
$post = mysqli_fetch_assoc($runPQ);
$url=$post['book_url'];
header("Location: $url")

?>