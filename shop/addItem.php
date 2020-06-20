<?php
include '../core/init.php';

if (isset($_POST['addItem'])) {
	$name = $_POST['name'];
	$qty = $_POST['quantity'];
	$category = $_POST['category'];
	$price = $_POST['price'];
	$shop = str_replace(' ','',$_POST['shop']);
	$sql = "INSERT INTO $shop(name, quantity, category, price) values('$name', $qty, '$category', $price)";
	if(mysqli_query($conn, $sql)){
		echo "<script>window.open('manageShop.php','_self')</script>";
	}
	else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
?>