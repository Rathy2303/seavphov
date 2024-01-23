<?php
require('../include/dbuser.php');
require('../include/function.php');
if (!isset($_SESSION['isUserLoggedIn'])) {
  header('Location:login.php');
} else {
  if (time() - $_SESSION['LAST_LOGIN_TIME'] > 300) {
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="css/index.css">
<body>
  <!-- Nav-Bar -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3">
      <a class="navbar-brand" href="#">Welcome Rathy</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../include/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- End Nav-Bar -->

  <!-- Sidebar -->
  <div id="side" class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
    <h3 class="w3-bar-item"><?= $admin['email'] ?></h3>
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
              ?> <option value="<?= $ct['id'] ?>"><?= $ct['name'] ?></option>

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
  <!-- Link Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- End Link Bootstrap JS -->
</body>
</html>