<?php
require ('db.php');
$post_id = $_GET['id'];
$stmp = $db->prepare("UPDATE book SET download=download+1 WHERE id=?");
$stmp->execute([$post_id]);
$postQuery = $db->prepare("SELECT book_url FROM book WHERE id=?");
$postQuery->execute([$post_id]);
$result = $postQuery->fetch(PDO::FETCH_BOTH);
header("Location: $result[0]");
?>