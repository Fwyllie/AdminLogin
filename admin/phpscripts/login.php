<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

  function logIn($username, $password, $ip){
    require_once('connect.php');

    // $updateLockip = "SELECT * FROM tbl_lockout WHERE lock_ip = {$ip}";
    // $attempts_set = mysqli_query($link, $updateLockip);
    // $attempts = 0;

    // if(mysqli_num_rows($attempts_set)){
    //   $lock = mysqli_fetch_array($attempts_set, MYSQLI_ASSOC);
    //   if ($lock['lock_attempts'] >3){
    //     $lockMessage = "YOU HAVE BEEN LOCKED OUT";
    //     return $lockMessage;
    //   }

    $username = mysqli_real_escape_string($link, $username);
    $password =  mysqli_real_escape_string($link, $password);
    $loginString = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
    $user_set = mysqli_query($link, $loginString);
    //else

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

      // $resetAttempts = "DELETE * FROM tbl_lockout WHERE lock_ip ={$ip}";
      // $deleteResult = mysqli_query($link, $resetAttempts);

      redirect_to("admin_index.php");
    // }else if($attempts < 3){
    //   // $attempts = $lock['lock_attempts'] + 1;
    //   // $updateAttempts = "UPDATE tbl_lockout SET lock_attempts = '{$attempts}' WHERE lock_ip = '{$ip}'";
    //   // $updateAtt = mysqli_query($link, $updateAttempts);
    //   // echo "Failed to log in. Your username or password was incorrect! :(";
    //   // echo $attempts + "/3 attemps"
    // }
    // else if($attempts === 3){
    //
    // }

    }else{
      echo "Failed to log in. Your username or password was incorrect! :(";
    }
    mysqli_close($link);
  }
// }

 ?>
