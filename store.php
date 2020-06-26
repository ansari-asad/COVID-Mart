<?php
	include 'includes/header.php';
	$name = $_GET['shop_name'];
?>
<head>
  <title>COVID-Mart | <?php echo $name; ?></title>
</head>
	
	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="blog">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1><?php echo $name; ?></h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $name; ?></li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

<div class="container cart_area">
	<div id="checkSlotBook" class="center">
		<div class="sorting">
			<button id="loadLogin" type="button" class="button button-login w-10">Login to Book Slot</button>
		</div>
		<p></p>
	</div>
	<div id="slotBook">
		<form action="confirmation.php" method="post">
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting">
					<select name="dateofslot" onchange="getSlots()" id="datesel">
						<?php
						$sql = "SELECT DISTINCT(date) FROM slots WHERE shop_name = '$name'";
						$runsql = $conn->query($sql);
						while ($row = $runsql->fetch_assoc()) {
							if (isset($_GET['datesel']) and $_GET['datesel'] == $row['date']) {
								echo '<option value="'.$row['date'].'" selected>'.$row['date'].'</option>';
							}
							else{
								echo '<option value="'.$row['date'].'">'.$row['date'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="sorting mr-auto">
					<select name="slot">
						<?php
						$dt = date("d/m/Y");
						if (isset($_GET['datesel'])) {
							$dt = $_GET['datesel'];
						}
						$sql = "SELECT * FROM slots WHERE shop_name = '$name' AND `date` = '$dt'";
						$runsql = $conn->query($sql);
						while ($row = $runsql->fetch_assoc()) {
							echo '<option value="'.$row['slot'].'">'.substr_replace( $row['slot'], ':', 2, 0 ).'</option>';
						}
						?>
					</select>
				</div>
				<input type="text" name="shop_name" value="<?php echo $name; ?>" hidden>
				<div class="sorting">
					<button type="submit" name="bookSlot" style="align-content: right;" class="button button-login w-10">Book Slot</button>
				</div>
			</div>
		</form>
	</div>

	<div class="cart_inner table-responsive">
	<table class="table">
		<thead>
			<th scope="col">Item ID</th>
			<th scope="col">Name</th>
			<th scope="col">Quantity</th>
			<th scope="col">Category</th>
			<th scope="col">Price</th>
			<th scope="col"></th>
		</thead>
		<tbody>
			<?php
			$shop = str_replace(' ', '', $name);
			$sql = "SELECT * FROM $shop";
			$runsql = $conn->query($sql);
			while ($row = $runsql->fetch_assoc()) {
				$qty = 5;
				if ($row['quantity'] < 5) {
					$qty = $row['quantity'];
				}
				echo '<tr>
				<td>'.$row['item_id'].'</td>
				<td>'.$row['name'].'</td>
				<td><div class="product_count">
                        <input type="text" name="quantity" id="sst'.$row['item_id'].'" maxlength="12" value="1" title="Quantity:" class="input-text qty" disabled>
                        <button onclick="var result = document.getElementById(\'sst'.$row['item_id'].'\');
                        var cost = document.getElementById(\'price'.$row['item_id'].'\');
                        var sst = result.value;
                        if( !isNaN( sst ) &amp;&amp; sst < '.$qty.'){
                        	result.value++;
                        	document.getElementById(\'initial'.$row['item_id'].'\').style.display = \'None\';
							cost.innerHTML = parseInt(document.getElementById(\'sst'.$row['item_id'].'\').value) * parseInt('.$row['price'].');
                        }
                        return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button onclick="var result = document.getElementById(\'sst'.$row['item_id'].'\');
                        var cost = document.getElementById(\'price'.$row['item_id'].'\');
                        var sst = result.value;
                        if( !isNaN( sst ) &amp;&amp; sst > 1 ){
                        	result.value--;
                        	document.getElementById(\'initial'.$row['item_id'].'\').style.display = \'None\';
                        	cost.innerHTML = parseInt(document.getElementById(\'sst'.$row['item_id'].'\').value) * parseInt('.$row['price'].');
                        }
                        return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div></td>
				<td>'.$row['category'].'</td>
				<td><p id="price'.$row['item_id'].'"><div id="initial'.$row['item_id'].'">'.$row['price'].'</div></p></td>
				<td>';
				echo '</td></tr>';
			}
			?>
		</tbody>
	</table>
	</div>
</div>

<script type="text/javascript">
	var dt = document.getElementById('datesel').value;

	if ("<?= isset($_SESSION['user_email']); ?>" == '1') {
		document.getElementById('checkSlotBook').style.display = 'None';
		// document.getElementById('slotBook').style.display = 'Block';
	}
	else{
		document.getElementById('slotBook').style.display = 'None';
		document.getElementById('loadLogin').addEventListener('click', (event) => {login()});
		// document.getElementById('checkSlotBook').style.display = 'Block';
	}

	function login(){
		window.location.href = 'login.php';
	}

	function getSlots() {
		var dt = document.getElementById('datesel').value;
		window.location.href = 'store.php?shop_name='+"<?= $_GET['shop_name']; ?>"+'&datesel='+dt;
	}
</script>

<style type="text/css">
	.center {
	  margin: auto;
	  text-align: center;
	  width: 60%;
	  padding: 10px;
	}
</style>

<?php
	include 'includes/footer.php';
?>