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
$admin = getAdminInfo($db, $_SESSION['email']);
?>
<!DOCTYPE html>
<html>
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../kh.png" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style2.css">
<body>

<!-- Sidebar -->
<div id="side" class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item"><?=$admin['email']?></h3>
  <a href="index.php" class="w3-bar-item w3-button active">Add Post</a>
  <a href="menu.php" class="w3-bar-item w3-button">Add Menu</a>
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
    <form action="../include/addpost.php" method="post" enctype="multipart/form-data">
        <h1>Add Post</h1>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Book Url</label>
            <input type="text" name="bookurl" class="form-control" id="bookurl" placeholder="Book Url">
          </div>
          <div class="mb-3">
            <label for="option" class="form-label">Choose Book Type</label>
            <select name="booktype" class="form-select">
            <?php
            $categories = getAllCategory($db);
                  foreach ($categories as $ct) {
                          ?> <option value="<?= $ct['id']?>"><?= $ct['name'] ?></option>
                         
                          <?php
                        }
                        ?>
            
            </select>
            
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Image</label>
            <input type="file" name="imagefile" value="" class="form-control" id="image">
          </div>
         
          <div class="text-center">
            <button type="submit" name="addpost" id="addpost" class="btn btn-primary ">Add Post</button>
        </div>
    </form>
    </div>
</div>

</div>
</body>
</html>
