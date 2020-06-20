<?php
session_start();
 include '../core/init.php';

if (isset($_POST['modify_category'])) {
	$cuisine='';
	if(!empty($_POST['cuisine']))
		foreach ($_POST['cuisine'] as $key) {
			$cuisine.=','.$key;
	}
	$cuisine = substr($cuisine, 1);
    $shop_name=str_replace(' ', '', $_SESSION['shop_name']);
    $sql = "UPDATE shops SET shop_cuisine='$cuisine' WHERE shop_name= '$shop_name' ";
    echo $sql;
    mysqli_query($conn, $sql);
    echo "<script>window.open('manageShop.php', '_self');</script>";
}

if( isset($_POST['slot_no'])){
    $num=$_POST['num'];
    $shop_name=str_replace(' ', '', $_SESSION['shop_name']);
    $sql = "UPDATE shops SET num=$num WHERE shop_name= '$shop_name' ";
    echo $sql;
    mysqli_query($conn, $sql);
    echo "<script>window.open('manageShop.php', '_self');</script>";

}
    ?>