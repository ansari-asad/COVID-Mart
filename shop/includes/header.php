<?php 
  session_start();
  include('../core/init.php');
?>
<!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.php"><img src="../img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              <?php
                if (isset($_SESSION['shop_email'])) {
                  echo '<li class="nav-item"><a href="manageShop.php" class="nav-link" >Manage Shop</a></li>';
                }
              ?>
              <li class="nav-item"><a class="nav-link" href="../contact.php">Contact</a></li>
            </ul>

            <ul class="nav-shop">
              <?php
                if (!isset($_SESSION['user_email'])) {
                  echo '<li class="nav-item"><a class="button button-header" href="../login.php">Login/Register</a></li>';
                }
                else{
                  echo $_SESSION['user_name'];
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