<?php
require('../include/dbuser.php');
  $edit_id = $_GET['id'];
  $sql = "DELETE FROM book WHERE id='$edit_id'";
  // Execute query
  mysqli_query($db, $sql);
  header('Location:../admin/editpost.php');

?>

