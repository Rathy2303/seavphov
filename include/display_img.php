<?php
    require_once './db.php';
    $id=$_GET['id'];
    $stmp = $db->prepare("SELECT image FROM book WHERE id=?");
    $stmp->bind_param('i',$id);
    $stmp->execute();
    $stmp->bind_result($imgData);
    $stmp->fetch();
    $stmp->close();
    header("Content-Type: image/jpeg");
    echo $imgData;
?>