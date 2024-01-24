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
<link rel="stylesheet" href="css/post.css">
<link rel="stylesheet" href="css/navbar.css">

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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item  active">
            <a class="nav-link" href="#">Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item" id="notification_box">
            <a class="nav-link" href="../include/logout.php">
              <i class="fa-solid fa-bell"></i>
              <span id="notification-count">1</span>
            </a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="../include/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- End Nav-Bar -->

  <!-- Content -->
  <div class="container mt-5">
    <!-- Table -->
    <section class="table-container">
      <table class="table table-bordered w-50">
        <thead>
          <tr>
            <th scope="col">TITLE</th>
            <th scope="col">TYPE</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $fetchdata = mysqli_query($db, "SELECT book.title,book.book_url,book.image,book.id,book.category_id,category.name FROM book INNER JOIN category on book.category_id=category.id");
          while ($row = mysqli_fetch_assoc($fetchdata)) {
          ?>
            <tr>
              <th scope="row"><?= $row['title']; ?></th>
              <td><?= $row['name'] ?></td>
              <td class="d-flex">
                <button type="button" data-id="<?= $row['id'] ?>" class="btn btn-danger mr-1 js-btn-delete" data-id="<?=$row['id'];?>" data-image="<?=$row['image'];?>" data-toggle="modal" data-target="#deleteModal">Delete</button>
                <button type="button" data-id="<?= $row['id'] ?>" data-title="<?= $row['title'] ?>" data-url="<?= $row['book_url'] ?>" data-type-id="<?= $row['category_id']; ?>" data-type="<?= $row['name'] ?>" class="btn btn-primary js-btn-edit" data-toggle="modal" data-target="#editModal">Edit</button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </section>
    <!-- End Table -->

    <!-- Edit Popup -->
    <div class="modal" tabindex="-1" id="editModal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="./php/update_book.php" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <h5 class="modal-title">Edit Book</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <input type="hidden" value="" id="book_id" name="book_id">
              <!-- Book Title -->
              <div class="form-group">
                <label for="exampleInputTitle">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title" aria-describedby="emailHelp" placeholder="Enter Book Title">
              </div>
              <!-- End Book Title -->

              <!-- Book Url -->
              <div class="form-group">
                <label for="exampleInputTitle">Book Url</label>
                <input type="text" class="form-control" id="book_url" name="book_url" aria-describedby="emailHelp" placeholder="Enter Book Url">
              </div>
              <!-- End Book Url -->

              <!-- Book Url -->
              <div class="form-group">
                <label for="exampleFormControlSelect1">Book Type</label>
                <select class="form-control" id="book_type_selected" name="book_type_selected">
                  <option id="book_type" value=""><?= $cate['name'] ?></option>
                  <!-- Fetch Category -->
                  <?php
                  $category = mysqli_query($db, "SELECT * FROM category");
                  while ($cate = mysqli_fetch_assoc($category)) {
                  ?>
                    <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                  <?php
                  }
                  ?>
                  <!-- End Fetch Category -->
                </select>
              </div>
              <!-- End Book Url -->
              <div class="form-group">
                <label for="exampleFormControlFile1">Image File</label>
                <input type="file" name="image" id="image" class="form-control-file" id="exampleFormControlFile1">
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" name="save" id="save" class="btn btn-primary" value="Save changes">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Edit Popup -->

    <!-- Delete Popup -->
    <div class="modal" tabindex="-1" id="deleteModal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Book</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" value="" id="book_id" name="book_id">
              <h3>Are You Sure to Delete?</h3>
            </div>
            <div class="modal-footer">
              <button id="btn-delete" class="btn btn-danger">Delete</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
    <!-- End Delete Popup -->

  </div>
  <!-- End Content -->


  <!-- Page Content
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
  </div> -->
  <!-- Link Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- End Link Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./script/post.js"></script>
</body>

</html>