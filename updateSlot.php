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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food1";

date_default_timezone_set('Asia/Kolkata');

$today = date("d/m/Y", strtotime("today"));

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
while (!$conn) {
	sleep(60);
	$conn = mysqli_connect($servername, $username, $password, $dbname);
}

$sql = "SELECT shop_name, shop_open, shop_close, num FROM shops";
while (!($runsql = $conn->query($sql))) {
	sleep(60);
}

while ($row = $runsql->fetch_assoc()) {
	$name = $row['shop_name'];
	$open = $row['shop_open'];
	$close = $row['shop_close'];
	$date1 = date("d/m/Y", strtotime("tomorrow"));
	$date2 = date("d/m/Y", strtotime("+2 Days"));
	$slot = slotList($open, $close);
	$num = $row['num'];
	$dates = array();

	// Get slot dates
	$sqlDates = "SELECT DISTINCT(date) FROM slots WHERE shop_name = '$name'";
	while (!($runsqlDates = $conn->query($sqlDates))) {
		sleep(5);
	}
	while ($rowDates = $runsqlDates->fetch_assoc()) {
		array_push($dates, $rowDates['date']);
	}

	// Delete unused slots
	$sqlDelete = "DELETE FROM slots WHERE shop_name = '$name' AND STR_TO_DATE(`date`,'%d/%m/%Y') < STR_TO_DATE('$today','%d/%m/%Y')";
	while (!($runsqlDelete = $conn->query($sqlDelete))) {
		sleep(5);
	}

	// Insert next slots
	if (!(in_array($today, $dates))) {
		foreach ($slot as $value){
		    $slotInsert= "INSERT INTO SLOTS values('$name','$today','$value','$num')";
		    while (!($runslotInsert = $conn->query($slotInsert))) {
		    	sleep(5);
		    }
		}
	}
	if (!(in_array($date1, $dates))) {
		foreach ($slot as $value){
		    $slotInsert= "INSERT INTO SLOTS values('$name','$date1','$value','$num')";
		    while (!($runslotInsert = $conn->query($slotInsert))) {
		    	sleep(5);
		    }
		}
	}
	if (!(in_array($date2, $dates))) {
		foreach ($slot as $value){
		    $slotInsert= "INSERT INTO SLOTS values('$name','$date2','$value','$num')";
		    while (!($runslotInsert = $conn->query($slotInsert))) {
		    	sleep(5);
		    }
		}
	}
}

// Delete previous day orders
$sql = "DELETE FROM `orders` WHERE STR_TO_DATE(`date`,'%d/%m/%Y') < STR_TO_DATE('$today','%d/%m/%Y')";
while (!($runsql = $conn->query($sql))) {
	sleep(5);
}

$conn->close();
?>