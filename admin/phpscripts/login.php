<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

  function logIn($username, $password, $ip){
    require_once('connect.php');

    // $lockString = "SELECT * FROM tbl_lockout" ;
    // $updateLockip = "INSERT INTO tbl_lockout ('lock_ip') VALUES ('{$ip}')";
    // $lockQuery = mysqli_query($link, $updateLockip);
    // $_SESSION['lock_ip'] = $ip;
    // $_SESSION['lock_attempts'] = "";

    $username = mysqli_real_escape_string($link, $username);
    $password =  mysqli_real_escape_string($link, $password);
    $loginString = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
    $user_set = mysqli_query($link, $loginString);
    if (mysqli_num_rows($user_set)) {
      $foundUser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $foundUser['user_id'];
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $foundUser['user_fname'];
      $_SESSION['last_login'] = $foundUser['user_lastlogin'];
      if(mysqli_query($link, $loginString)){
        $updateIp =  "UPDATE tbl_user SET user_ip = '{$ip}' WHERE user_id = {$id}";
        $updateLogin = "UPDATE tbl_user SET user_lastlogin = NOW() WHERE user_id = {$id}";
        $updateQuery = mysqli_query($link, $updateIp);
        $updateQuery2 = mysqli_query($link, $updateLogin);
      }
      redirect_to("admin_index.php");
    }else if ($_SESSION['lock_attempts'] <= 3){
      $message = "<p id=\"invalidLogin\">Your Password or username was incorrect!</p>";
      return $message;
      $updateAttempts = "UPDATE tbl_lockout SET lock_attempts = lock_attempts + 1 WHERE lock_ip = {$ip}";
      echo "Failed to log in. Attempt: {$_SESSION['num_attempts']} of 4.";
    }else if($_SESSION['lock_attempts'] > 3){
      $message =  "LOCKED OUT";
      return $message;
    }
    mysqli_close($link);
  }

 ?>
