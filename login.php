<?php
	include 'includes/header.php';
?>
<head>
  <title>COVID-Mart | Login</title>
</head>
  
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
								<button type="submit" value="submit" id="submit" name="submit" class="button button-login w-100">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

<script type="text/javascript">
  	document.getElementById('submit').addEventListener('click', (event) => {checkValues(event)});

  	function checkValues(evt) {
  		var pwd = document.getElementById('password').value;
  		var cnf = document.getElementById('confirmPassword').value;
  		if (pwn != cnf) {
  			alert('Passwords do not match!');
  			evt.preventDefault();
  		}
  	}
</script>

<?php
	include 'includes/footer.php';
?>

<?php 
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql_user = "SELECT * FROM users WHERE user_email = '$email'";
		$sql_shop = "SELECT * FROM shops WHERE shop_email = '$email'";
		$runsql=$conn->query($sql_user);
		$row = $runsql->fetch_assoc();

		if($runsql->num_rows > 0 and password_verify($password, $row['user_password'])){
			$_SESSION['user_email'] = $email;
			$_SESSION['user_name'] = $row['user_name'];
			echo "<script>alert('You logged in successfully!')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		}
		else{
			$runsql=$conn->query($sql_shop);
			$row = $runsql->fetch_assoc();

			if($runsql->num_rows > 0 and password_verify($password, $row['shop_password'])){
				$_SESSION['shop_email'] = $email;
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