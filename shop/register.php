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
							<a class="button button-account" href="../login.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<form class="row login_form" action="register.php" id="register_form" method="post">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Shop Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Shop Name'" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="textarea" class="form-control" id="Address" name="Address" placeholder="Shop Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Shop Address'" required>
							</div>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required>
              </div>
              <div class="col-md-12 form-group">
              	<button type="button" id="butn" class="button button-login">Image of Shop<input type="file" id="image" name="image" hidden></button>
              </div>
              <div class="col-md-12 form-group filter-bar">
              	Select Category
              	<div class="creat_account">
                <input type="checkbox" id="f-option1" name="cuisine[]" value="Medical">
                <label for="f-option1">Medical</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option2" name="cuisine[]" value="Fruits & Vegetables">
                <label for="f-option2">Fruits & Vegetables</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option3" name="cuisine[]" value="Household">
                <label for="f-option3">Household</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option4" name="cuisine[]" value="Packaged Food">
                <label for="f-option4">Packaged Food</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option5" name="cuisine[]" value="Eggs & Meat">
                <label for="f-option5">Eggs & Meat</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option6" name="cuisine[]" value="Beauty & Hygiene">
                <label for="f-option6">Beauty & Hygiene</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option7" name="cuisine[]" value="Others">
                <label for="f-option7">Others</label>
                </div>
              </div>
              <div class="col-md-12 form-group filter-bar">
              	Timings<br>
              	<div class="sorting col-xl-9 col-lg-8 col-md-7">
              		<label for="open">Opening Time</label>
              		<select name="open" id="open">
              			<option value="9:00">09:00</option>
						<option value="10:00">10:00</option>
						<option value="11:00">11:00</option>
              		</select>
              	</div>
              	<div class="sorting col-xl-9 col-lg-8 col-md-7">
              		<label for="close">Closing Time</label>
              		<select name="close" id="close">
              			<option value="21:00">21:00</option>
						<option value="22:00">22:00</option>
						<option value="23:00">23:00</option>
              		</select>
              	</div>
              </div>
              <div class="col-md-12 form-group">
								<input type="number" class="form-control" id="num" name="num" placeholder="No. of people per 30 min slot" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No. of people per 30 min slot'" min="1" max="20" required>
              </div>
              <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
              </div>
              <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required>
							</div>
							<div class="col-md-12 form-group">
								<button id="submit" type="submit" value="submit" name="submit" class="button button-register w-100">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

  <script type="text/javascript">
  	document.getElementById('butn').addEventListener('click', openDialog);

  	document.getElementById('submit').addEventListener('click', (event) => {checkValues(event)});

  	function checkValues(evt) {
  		var pwd = document.getElementById('password').value;
  		var cnf = document.getElementById('confirmPassword').value;
  		if (pwn != cnf) {
  			alert('Passwords do not match!');
  			evt.preventDefault();
  		}
  		getSelectedCheckboxValues(evt);
  	}

  	function getSelectedCheckboxValues(evt) {
	    const checkboxes = document.querySelectorAll(`input[name="cuisine[]"]:checked`);
	    checkboxes.forEach((checkbox) => {
	        if (checkbox.checked == checked) {
	        	return;
	        }
	    });
	    alert('Select the Category!');
	    evt.preventDefault();
	}

	function openDialog() {
	  document.getElementById('image').click();
	}
  </script>

<?php
	include 'includes/footer.php';
?>

<?php
function slotList($start,$close){
    $start=explode(':',$start);
    $close=explode(':',$close);
    $slot=array();
    while($start[0]<$close[0]){
        $slot[] = $start[0].'00';
        $slot[] = $start[0].'30';
        $start[0] = (int)$start[0] + 1;
        $start[0] = (string)$start[0];
    }
    return $slot;
}
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$address = $_POST['Address'];
	$email = $_POST['email'];
	$cuisine='';
	if(!empty($_POST['cuisine']))
		foreach ($_POST['cuisine'] as $key) {
			$cuisine.=','.$key;
	}
	$cuisine = substr($cuisine, 1);
	$open = $_POST['open'];
	$close = $_POST['close'];
	$slot = slotList($open,$close);
	$num = $_POST['num'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

  if ($password != $confirmPassword) {
    echo "<script>alert('Passwords do not match!');</script>";
    echo "<script>window.open('register.php', '_self');</script>";
    exit();
  }

	$sql = "SELECT * FROM shops WHERE shop_email='$email'";
	$result = mysqli_query($conn, $sql);
  $resultcheck = mysqli_num_rows($result);
  if($resultcheck > 0){
     echo "<script>alert('Email already in Use!');</script>";
     echo "<script>window.open('register.php', '_self');</script>";
     exit();
  }
  else{
    $sql = "SELECT * FROM shops WHERE shop_name='$name' AND shop_address='$address'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck > 0){
       echo "<script>alert('Shop already in Registered!');</script>";
       echo "<script>window.open('login.php', '_self');</script>";
       exit();
    }
  }

  $hashpwd = password_hash($password,PASSWORD_DEFAULT);
  $value =0;
	if(isset($_FILES['image'])){
		$image =  $_FILES['image'];
		print_r($image);
		$imagename = $_FILES['image']['name'];
		$fileExtension = explode('.', $imagename);
		$fileCheck = strtolower(end($fileExtension));
		$fileExtensionStored = array('png','jpg','jpeg');
		if(in_array($fileCheck, $fileExtensionStored)){
			$destinationFile = 'images/'.$imagename;
			move_uploaded_file($_FILES['image']['tmp_name'], $destinationFile);
			$sqlInsert = "INSERT INTO shops(shop_name,shop_address,shop_email,shop_open,shop_close,shop_cuisine,shop_rating,shop_image,num,shop_password) 
			values('$name','$address','$email','$open','$close','$cuisine','0','$destinationFile','$num','$hashpwd');";
			mysqli_query($conn,$sqlInsert);
		}
		else{
			echo "<script>alert('Only png, jpg, and jpeg formats supported!');</script>";
			echo "<script>window.open('register.php', '_self');</script>";
		}
	}
	else{
		$sqlInsert = "INSERT INTO shops(shop_name,shop_address,shop_email,shop_open,shop_close,shop_cuisine,shop_rating,num,shop_password) 
			values('$name','$address','$email','$open','$close','$cuisine','0','$num','$hashpwd');";
		mysqli_query($conn,$sqlInsert);
	}
	foreach ($slot as $value){
        $slotInsert= "INSERT INTO SLOTS values('$email','$value','$num')";
        if(!mysqli_query($conn,$slotInsert)){
            echo mysqli_error($conn);
        }
    }
	$restname = str_replace(' ','',$name);
	$addRest="CREATE table $restname(
		dish_id int(100) Auto_increment primary key,
		cuisine varchar(50),
		type varchar(50),
		cost int(100)
	)";
	if(!mysqli_query($conn,$addRest))
		echo mysqli_error($conn);
	echo "<script>window.open('../login.php', '_self');</script>";
	mysqli_close($conn);
}
?>