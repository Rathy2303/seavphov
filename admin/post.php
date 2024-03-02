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
$username = $_SESSION['username'];
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
      <a class="navbar-brand" href="#">Welcome <?=$username?></a>
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
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <form class="form-inline">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success my-2 my-sm-0 mr-5" type="submit">Search</button>
            </form>
          </li>
          <li class="nav-item">
            <span class="nav-link">
              <i class="fa-solid fa-plus" style="cursor: pointer;" data-toggle="modal" data-target="#addModal"></i>
            <span>
          </li>
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
    <section class="table-container items-center flex-column align-items-center">
      <table class="table table-bordered w-50">
        <thead class="table-dark">
          <tr>
            <th scope="col">TITLE</th>
            <th scope="col">TYPE</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(isset($_GET['page'])){
            $page=$_GET['page'];
          }else{
            $page = 1;
          }
          $getpage = $db->prepare("SELECT id FROM book");
          $getpage->execute();
          $number_per_page = 8;
          $totalpage =  ceil($getpage->rowCount()) / $number_per_page;
          $startpage = ($page-1) * $number_per_page;
          $fetchdata = $db->prepare("SELECT book.title,book.book_url,book.id,book.category_id,category.name FROM book INNER JOIN category on book.category_id=category.id ORDER BY id DESC LIMIT $startpage,$number_per_page");
          $fetchdata->execute();
          $rows = $fetchdata->fetchAll(PDO::FETCH_CLASS);
          foreach($rows as $row) {
          ?>
            <tr>
              <th scope="row"><?= $row->title; ?></th>
              <td><?= $row->name?></td>
              <td class="d-flex">
                <button type="button" data-id="<?= $row->id?>" class="btn btn-danger mr-1 js-btn-delete" data-id="<?= $row->id?>" data-toggle="modal" data-target="#deleteModal">Delete</button>
                <button type="button" data-id="<?= $row->id?>" data-title="<?= $row->title?>" data-url="<?= $row->book_url?>" data-type-id="<?= $row->category_id?>" data-type="<?=$row->name?>" class="btn btn-primary js-btn-edit" data-toggle="modal" data-target="#editModal">Edit</button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <div>
        <?php
          if($page==1){
            echo ' <a class="btn btn-dark px-3 mx-1" href="" style="pointer-events: none;cursor: default;opacity: 0.8"><i class="fa-solid fa-angles-left"></i></a>';
          }else if($page>1){
            $previous = $page -1;
            echo ' <a class="btn btn-dark px-3 mx-1" href="post.php?page='.$previous.'"><i class="fa-solid fa-angles-left"></i></a>';
          }
          for($i=1;$i<=$totalpage;$i++){
            if($page==$i){
              echo ' <a class="btn btn-primary px-3 mx-1" href="post.php?page='.$i.'">'.$i.'</a>';
            }else{
              echo ' <a class="btn btn-dark px-3 mx-1" href="post.php?page='.$i.'">'.$i.'</a>';
            }
          }
          if($page==$totalpage){
            echo ' <a class="btn btn-dark px-3 mx-1" href="" style="pointer-events: none;cursor: default;opacity: 0.8"><i class="fa-solid fa-angles-right"></i></a>';
          }else if($page<$totalpage){
            $next = $page+1;
            echo '<a class="btn btn-dark px-3 mx-1" href="post.php?page='.$next.'"><i class="fa-solid fa-angles-right"></i></a';
          }
        ?>
      </div>
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
                  try {
                    $category = $db->prepare("SELECT * FROM category");
                    $category->execute();
                    $row = $category->fetchAll(PDO::FETCH_CLASS);
                    foreach($rowas as $cate){
                    ?>
                      <option value="<?= $cate->id?>"><?= $cate->name?></option>
                    <?php
                    }
                  } catch (Exception $e) {
                    //throw $th;
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

    <!-- Add Popup -->
    <div class="modal" tabindex="-1" id="addModal" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="./php/add_book.php" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <h5 class="modal-title">Add Book</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" value="" id="book_id" name="book_id">
              <!-- Book Title -->
              <div class="form-group">
                <label for="exampleInputTitle">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title" aria-describedby="emailHelp" placeholder="Enter Book Title" require>
              </div>
              <!-- End Book Title -->

              <!-- Book Url -->
              <div class="form-group">
                <label for="exampleInputTitle">Book Url</label>
                <input type="text" class="form-control" id="book_url" name="book_url" aria-describedby="emailHelp" placeholder="Enter Book Url" require>
              </div>
              <!-- End Book Url -->

              <!-- Book Url -->
              <div class="form-group">
                <label for="exampleFormControlSelect1">Book Type</label>
                <select class="form-control" id="book_type_selected" name="book_type_selected">
                  <!-- Fetch Category -->
                  <?php
                  try {
                    $category = $db->prepare("SELECT * FROM category");
                    $category->execute();
                    $row = $category->fetchAll(PDO::FETCH_CLASS);
                    foreach($row as $cate){
                    ?>
                      <option value="<?= $cate->id?>"><?= $cate->name?></option>
                    <?php
                    }
                  } catch (Exception $e) {
                    echo $e->getMessage();
                  }
           
                  ?>
                  <!-- End Fetch Category -->
                </select>
              </div>
              <!-- End Book Url -->
              <div class="form-group">
                <label for="exampleFormControlFile1">Image File</label>
                <input type="file" accept="image/jpg , image/jpeg, image/png" name="image" id="image" class="form-control-file" id="exampleFormControlFile1">
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" name="add" id="add" class="btn btn-primary" value="Add">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Add Popup -->

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

  <!-- Link Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- End Link Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./script/post.js"></script>
</body>

</html>