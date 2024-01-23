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
$edit_id;
$admin = getAdminInfo($db, $_SESSION['email']);
?>
<!DOCTYPE html>
<html>
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../kh.png" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="edcss.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<body>

  <!-- Sidebar -->
<div id="side" class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item"><?=$admin['email']?></h3>
  <a href="index.php" class="w3-bar-item w3-button">Add Post</a>
  <a href="menu.php" class="w3-bar-item w3-button">Add Menu</a>
  <a href="editpost.php" class="w3-bar-item w3-button active">Edit Post</a>
  <a href="../include/logout.php" class="w3-bar-item w3-button">Sign Out</a>
</div>

  <!-- Page Content -->
  <div style="margin-left:25%">

    <div class="w3-container w3-teal">
      <h1 id="htitle">Admin Panel</h1>
    </div>


    <div class="w3-container">
      <div class="edit_page">


        <div class="wrapper">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
 
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Title</th>
                      <th scope="col">Book URL</th>
                      <th scope="col">Book Type</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php
                    $query = "SELECT * FROM book ORDER BY  id DESC";
                    $run = mysqli_query($db, $query);
                    while ($menu = mysqli_fetch_assoc($run)) {
                      ?>
                       
                      <tr>
                        <th scope="row">
                          <?= $menu['title'] ?>
                        </th>
                        <td class="">
                          <?= $menu['book_url'] ?>
                        </td>
                        <td class="">
                          <?= $menu['category_id'] ?>
                        </td>
                        <td>
                          <a href="edit.php?id=<?=$menu['id']?>" target="_blank">Edit</a>
                          <a href="../include/delete.php?id=<?=$menu['id']?>" target="_blank">Delete</a>
                   
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
          
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

</body>

</html>