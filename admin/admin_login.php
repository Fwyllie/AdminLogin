<?php
    require_once('phpscripts/config.php');
    $ip = $_SERVER['REMOTE_ADDR'];
    if(isset($_POST['submit'])){
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      if($username !== "" && $password !== ""){
        $result = logIn($username, $password, $ip);
        $message = $result;
      }else{
        $message = "Please fill out the required fields.";
      }
    }
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Panel Login</title>
<link rel="stylesheet" href="./css/app.css" media="screen">
</head>
<body>
  <?php if (!empty($message)) {
    echo $message;
  } ?>
  <div id="container">
    <form id="loginForm" action="admin_login.php" method="post">
      <h1>Admin Login</h1>
      <input id="uname" type="text" name="username" value="" placeholder="Username:">
      <br><br>
      <input id="pass" type="password" name="password" value="" placeholder="Password:">
      <br>
      <input id="submit" type="submit" name="submit" value="Login">
    </form>
  </div>
</body>
</html>
