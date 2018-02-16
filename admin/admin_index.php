<?php
  require_once('phpscripts/config.php');
  confirm_logged_in();

  ini_set('display_errors', 1);
  error_reporting(E_ALL);
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to your admin panel!</title>
    <link rel="stylesheet" href="./css/app.css" media="screen">
  </head>
  <body>
    <p id="welcomeMsg">Welcome to your Admin Panel</p>
    <?php
    date_default_timezone_set("America/Toronto");
    $hour = date('H');
    if ( $hour < 12 ) {
      echo "<h1 id=\"timeMsgMorning\">Good Morning {$_SESSION['user_name']}</h1>";
    } else if ( $hour >= 19) {
      echo "<h1 id=\"timeMsgNight\">Good Evening {$_SESSION['user_name']}</h1>";
    }else if ( $hour >= 12) {
      echo "<h1 id=\"timeMsgAfternoon\">Good Afternoon {$_SESSION['user_name']}</h1>";
    }

    echo "<p>Last Login: {$_SESSION['last_login']}</p>";
    ?>
  </div>
  </body>
</html>
