<?php
    require ("db.php");

    $result = $db->query("SELECT title,book_url,image FROM book");
    $list = array();
    if ($result){
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
    }

    echo json_encode(array("bookData" => $list));
}
return $result->close();
$db->close();
?>