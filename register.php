<?php
	include 'includes/header.php';
?>
<head>
  <title>COVID-Mart | Register</title>
</head>
  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Register</li>
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
							<h4>Already have an account?</h4>
							<a class="button button-account" href="login.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<form class="row login_form" action="register.php" id="register_form" method="post">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required>
              </div>
              <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
              </div>
              <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" id="submit" name="submit" class="button button-login w-100">Register</button>
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
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	if ($password != $confirmPassword) {
    	echo "<script>alert('Passwords do not match!');</script>";
    	echo "<script>window.open('register.php', '_self');</script>";
    	exit();
    }

	$sql = "SELECT * FROM users WHERE user_email='$email'";
	$result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck > 0){
       echo "<script>alert('Email already in Use!');</script>";
       echo "<script>window.open('register.php', '_self');</script>";
       exit();
    }

    $hashpwd = password_hash($password,PASSWORD_DEFAULT);
	$sql = "INSERT INTO users(user_name,user_email,user_password) VALUES ('$name','$email','$hashpwd')";

	if (mysqli_query($conn, $sql)) {
		echo "<script>window.open('login.php', '_self');</script>";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}
?>