<?php 
  session_start();
  include('../core/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="../img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <?php
            if (isset($_SESSION['shop_email'])) {
              echo '<a class="navbar-brand logo_h" href="index.php">';
            }
            else{
              echo '<a class="navbar-brand logo_h" href="../index.php">';
            }
          ?>
          <img src="../img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item">
              <?php
                if (isset($_SESSION['shop_email'])) {
                  echo '<a class="nav-link" href="index.php">';
                }
                else{
                  echo '<a class="nav-link" href="../index.php">';
                }
              ?>
              Home</a></li>
              <?php
                if (isset($_SESSION['shop_email'])) {
                  echo '<li class="nav-item"><a href="manageShop.php" class="nav-link" >Manage Shop</a></li>';
                }
              ?>
              <li class="nav-item"><a class="nav-link" href="./contact.php">Contact</a></li>
            </ul>

            <ul class="nav-shop">
              <?php
                if (!isset($_SESSION['shop_email'])) {
                  echo '<li class="nav-item"><a class="button button-header" href="../login.php">Login/Register</a></li>';
                }
                else{
                  echo $_SESSION['shop_name'];
                  echo '<li class="nav-item"><a class="button button-header" href="../logout.php">Logout</a></li>';
                }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
<!--================ End Header Menu Area =================-->