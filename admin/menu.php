<?php
require('../include/dbuser.php');
require('../include/function.php');
if (!isset($_SESSION['isUserLoggedIn'])) {
  header('Location:login.php');
}else{
  if(time()-$_SESSION['LAST_LOGIN_TIME'] >300) 
    {
        session_unset();
        session_destroy();
        header("Location:../include/logout.php");
    }
}

// Menu
// If upload button is clicked ...
if (isset($_POST['addmenu'])) {
    $ptitle=mysqli_real_escape_string($db,$_POST['title']);
    $name=mysqli_real_escape_string($db,$_POST['name']);
    $menuurl=mysqli_real_escape_string($db,$_POST['menuurl']);
    $sql = "INSERT INTO menu (title, name,url) VALUES ('$ptitle','$name','$menuurl')";
    $sqlcategory = "INSERT INTO category (name) VALUES ('$ptitle')";
    // Execute query
    mysqli_query($db, $sql);
    mysqli_query($db, $sqlcategory);
    header('Location:menu.php');
}

$admin = getAdminInfo($db, $_SESSION['email']);
?>
<!DOCTYPE html>
<html>
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="shortcut icon" href="../kh.png" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style2.css">
<body>

<!-- Sidebar -->
<div id="side" class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item"><?=$admin['email']?></h3>
  <a href="index.php" class="w3-bar-item w3-button">Add Post</a>
  <a href="menu.php" class="w3-bar-item w3-button active">Add Menu</a>
  <a href="editpost.php" class="w3-bar-item w3-button">Edit Post</a>
  <a href="../include/logout.php" class="w3-bar-item w3-button">Sign Out</a>
</div>
<!-- Page Content -->
<div style="margin-left:25%">

<div class="w3-container w3-teal">
  <h1>Admin Panel</h1>
</div>
<div class="w3-container">
    <div class="wrapper-content">
    <form action="menu.php" method="post" enctype="multipart/form-data">
        <h1>Add Menu</h1>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Menu Title">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Menu Name">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">URL</label>
            <input type="text" name="menuurl" class="form-control" id="url" placeholder="Menu URL">
          </div>
         
          <div class="text-center">
            <button type="submit" name="addmenu" id="addpost" class="btn btn-primary ">Add Menu</button>
        </div>
    </form>
    </div>
</div>

</div>
      
</body>
</html>
