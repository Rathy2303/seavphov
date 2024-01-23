<?php

require('../include/dbuser.php');

require('../include/function.php');



if(isset($_POST['savechange'])){

  $edit_id = $_GET['id'];
  $getImage = "SELECT * FROM book WHERE id=$edit_id";
  $filename=$_FILES["upimg"]["name"];
  $runpq = mysqli_query($db, $getImage);
  $runqr = mysqli_fetch_assoc($runpq);
  $path = '../images/book/'.$runqr['image'];
  $ptitle=mysqli_real_escape_string($db,$_POST['title']);
  $bookurl=mysqli_real_escape_string($db,$_POST['bookurl']);
  $folder = "../images/book/".basename($filename);
  
  $cid=$_POST['booktype'];
  $sql="";
  if ($filename==""){
    // No file was selected for upload, your (re)action goes here
    $sql = "UPDATE book SET title='$ptitle',book_url='$bookurl',category_id='$cid' WHERE id='$edit_id'";
  }else{
    $sql = "UPDATE book SET title='$ptitle',image='$filename',book_url='$bookurl',category_id='$cid' WHERE id='$edit_id'";
    @unlink($path);
}
  // Execute query
  mysqli_query($db, $sql);
  if (move_uploaded_file($_FILES["upimg"]["tmp_name"], $folder)) {
    echo "<h3>  Image uploaded successfully!</h3>";
} else {
    echo "<h3>  Failed to upload image!</h3>";
}
  header('Location:../admin/editpost.php');
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"

  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="edcss.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>

    *{

        margin: 0;

        padding: 0;

        box-sizing: border-box;

    }

    .wrapper{

        width: 100%;

        height: 100vh;

        display: flex;

        align-items: center;

        justify-content: center;

    }

    .wrapper .content{

        width: 50%;

        background-color: #E8E8E8;

        height: 320px;

        padding: 20px;

    }

</style>

</head>

<body>

    <div class="wrapper">

     <div class="content">

        <div class="mb-3">

          <form action="" method="post" enctype="multipart/form-data">        

            <?php

                $edit_id = $_GET['id'];

                $postQuery = "SELECT * FROM book WHERE id=$edit_id";

                $runpq = mysqli_query($db, $postQuery);

                $runqr = mysqli_fetch_assoc($runpq);

                ?>

                      <label for="exampleFormControlInput1" class="form-label">Title</label>

            <input type="text" class="form-control" value="<?=$runqr['title']?>" name="title" id="exampleFormControlInput1">

            <br>

            <label for="exampleFormControlInput1" class="form-label">Book URL</label>

            <input type="text" class="form-control" value="<?=$runqr['book_url']?>" name="bookurl" id="exampleFormControlInput1">

            <br>
            <label for="exampleFormControlInput1" class="form-label">Image</label>
            <input type="file" class="form-control" name="upimg" id="exampleFormControlInput1"/>
            <br>

            <div class="mb-3">

            <label for="option" class="form-label">Choose Book Type</label>

            <select name="booktype" class="form-select form-select-lg">

            <?php

            $categories = getAllCategory($db);

                  foreach ($categories as $ct) {

                          ?> 

                          <option value="<?=$ct['id']?>"><?=$ct['name'] ?></option>

                          <?php

                        }

                        ?>

                    </select>

            

            </div>

                <br>

          <div class="text-center">

            <input class="btn btn-primary" type="submit" name="savechange" value="Save Change">

            </div>

          </form>

          </div>

     </div>

    </div>

</body>

</html>











