<?php

  require('../include/dbuser.php');
  if(isset($_SESSION['isUserLoggedIn'])){
    header('Location:index.php');
  }
  if(isset($_POST['login'])){
    $email= $_POST['email'];
    $pass = $_POST['password'];
    $query= $db->prepare("SELECT * FROM admin where email=:email AND password=:password");
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':password',$pass,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_CLASS);
    if($query->rowCount() > 0){
      $_SESSION['isUserLoggedIn']=true;
      $_SESSION['LAST_LOGIN_TIME']= time();
      $_SESSION['email']=$email;
      $_SESSION['username']=$result['name'];
      header('Location:index.php');
    }else{
     echo "<script>alert('Incorrect email or password');</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../kh.png" />
    <title>Login To Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
    <!-- Logo -->
    <br><br>
    <center>
      <img src="../images/khmer_logo_black.png" alt="" height="100">
  </center>
    <!-- End Logo -->
        <div class="content">
            <form method="post">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" name="login" id="login" class="btn btn-primary w-100">Login</button>
                </div>
              </form>
        </div>
    </div>
</body>
</html>

