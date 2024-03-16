<?php

  require('../include/dbuser.php');
  if(isset($_SESSION['isUserLoggedIn'])){
    header('Location:index.php');
  }
  $status = "";
  $litheader = "";
  $title = "Login";
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
      $status = "denied";
      $title = "Access Denied";
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
    <link rel="stylesheet" href="css/login.css">
  </head>
<body>
  <div class="background-wrap">
    <div class="background"></div>
  </div>
  <form id="accesspanel" method="post">
    <h1 id="litheader">SEAV PHOV</h1>
    <div class="inset">
      <p>
        <input type="text" name="email" id="email" placeholder="Email address">
      </p>
      <p>
        <input type="password" name="password" id="password" placeholder="Password">
      </p>
      <div style="text-align: center;">
        <div class="checkboxouter">
          <input type="checkbox" name="rememberme" id="remember" value="Remember">
          <label class="checkbox"></label>
        </div>
        <label for="remember">Show Password</label>
      </div>
      <input class="loginLoginValue" type="hidden" name="service" value="login" />
    </div>
    <p class="p-container">
      <input type="submit" class="<?=$status?>" name="login" id="go" value="<?=$title?>">
    </p>
  </form>

  <!-- Java Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      e.preventDefault();
      $("#remember").on('click',function(){
        let input = document.getElementById("password");
        $(this)[0].checked ? input.type = "text" : input.type = "password";
      });
    });
  </script>
</body>
</html>

