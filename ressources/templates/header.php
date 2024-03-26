<?php
require_once "../src/common.php";
$logged_in = FALSE;
if(isset($_SESSION['login_user'])){
  $logged_in = TRUE;
  $header_username = $_SESSION['login_user'];
  $header_user_id = $_SESSION['login_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Twitter Clone</title>
  <link rel="stylesheet" href="../resources/css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
crossorigin="anonymous"></script>
</head>
<header>
  <nav>
    <div class="nav-wrapper light-blue">
      <a href="index.php" class="brand-logo center">Twitter Clone</a>
      <div class="container">
      <ul id="nav-mobile" class="left hide-on-med-and-down">
          <?php 
          if($logged_in){
            echo '<li><a href="logout.php">Logout</a></li>';
            echo '<li><a href="user_list.php">Users</a></li>';
            echo '<li><a href="user.php?id='.$header_user_id.'">'.$header_username.'</a></li>';
           } 
           else {
            echo '<li><a href="login.php">Login</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
          }?>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="about.php">About</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<main>
<body class="light-blue lighten-3 ">