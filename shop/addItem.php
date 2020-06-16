<?php
include '../core/init.php';

if (isset($_POST['addItem'])) {
	$name = $_POST['name'];
	$qty = $_POST['quantity'];
	$price = $_POST['price'];
	$shop = str_replace(' ','',$_POST['shop']);
	$sql = "INSERT INTO $shop(name, quantity, price) values('$name', $qty, $price)";
	mysqli_query($conn, $sql);
	echo "<script>window.open('manageShop.php','_self')</script>";
}
?>