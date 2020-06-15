<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>COVID-Mart | Login</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php
		include 'includes/header.php';
	?>
  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Login / Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Login/Register</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<p><h4>New to our website?</h4></p>
							<p><a class="button button-account" href="register.php">Register as a Customer</a></p>
							<a class="button button-account" href="shop/register.php">Register as a Shop</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="login.php" id="contactForm" method="post">
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" name="submit" class="button button-login w-100">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->



  <?php
  	include 'includes/footer.php';
  ?>



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>

<?php 
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql_user = "SELECT * FROM users WHERE user_password = '$password' AND user_email = '$email'";
		$sql_shop = "SELECT * FROM shops WHERE shop_password = '$password' AND shop_email = '$email'";
		$runsql=$conn->query($sql_user);

		if($runsql->num_rows > 0){
			$_SESSION['user_email'] = $email;
			$row = $runsql->fetch_assoc();
			$_SESSION['user_name'] = $row['user_name'];
			echo "<script>alert('You logged in successfully!')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		}
		else{
			$runsql=$conn->query($sql_shop);
			if($runsql->num_rows > 0){
				$_SESSION['shop_email'] = $email;
				$row = $runsql->fetch_assoc();
				$_SESSION['shop_name'] = $row['shop_name'];
				echo "<script>alert('You logged in successfully!')</script>";
				echo "<script>window.open('shop/index.php','_self')</script>";
			}
			else{
				echo "<script>alert('Your password or email is incorrect, please try again!')</script>";
				echo "<script>window.open('login.php', '_self');</script>";
				exit();
			}
		}
	}
?>