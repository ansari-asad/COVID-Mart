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
			<button type="button" onclick="login()" class="button button-login w-10">Login to Book Slot</button>
		</div>
		<p></p>
	</div>
	<div id="slotBook">
		<form action="confirmation.php" method="post">
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting">
					<select name="dateofslot" onchange="getSlots()" id="datesel">
						<?php
						$sql = "SELECT DISTINCT(STR_TO_DATE(`date`, '%d/%m/%Y')) AS slot_dates FROM slots WHERE shop_name = '$name' ORDER BY slot_dates";
						$runsql = $conn->query($sql);
						while ($row = $runsql->fetch_assoc()) {
							$date = implode("/", array_reverse(explode("-", $row['slot_dates'])));
							if (isset($_GET['datesel']) and $_GET['datesel'] == $date) {
								echo '<option value="'.$date.'" selected>'.$date.'</option>';
							}
							else{
								echo '<option value="'.$date.'">'.$date.'</option>';
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

	<script type="text/javascript">
		function calcTotal(toAdd, cost){
			tot = document.getElementById('total');
			if (toAdd) {
				tot.innerHTML = parseInt(tot.textContent) + cost;
			}
			else {
				tot.innerHTML = parseInt(tot.textContent) - cost;
			}
			if (tot.textContent == 0)
				document.getElementById('checkout').style.display = 'None';
			else
				document.getElementById('checkout').style.display = 'Block';
		}
	</script>

	<div class="cart_inner table-responsive">
	<table class="table">
		<thead>
			<th scope="col">Item ID</th>
			<th scope="col">Name</th>
			<th scope="col">Quantity</th>
			<th scope="col">Category</th>
			<th scope="col">Price (₹)</th>
		</thead>
		<tbody>
			<?php
			$shop = str_replace(' ', '', $name);
			$sql = "SELECT * FROM $shop";
			$runsql = $conn->query($sql);
			$items = array();
			while ($row = $runsql->fetch_assoc()) {
				$qty = 5;
				if ($row['quantity'] < 5) {
					$qty = $row['quantity'];
				}
				echo '<tr>
				<td>'.$row['item_id'].'</td>
				<td>'.$row['name'].'</td>
				<td><div class="product_count">
                        <input type="text" name="quantity" id="sst'.$row['item_id'].'" maxlength="12" value="0" title="Quantity:" class="input-text qty" disabled>
                        <button onclick="var result = document.getElementById(\'sst'.$row['item_id'].'\');
                        var cost = document.getElementById(\'price'.$row['item_id'].'\');
                        var sst = result.value;
                        if( !isNaN( sst ) &amp;&amp; sst < '.$qty.'){
                        	result.value++;
                        	calcTotal(1, '.$row['price'].');
							cost.innerHTML = parseInt(document.getElementById(\'sst'.$row['item_id'].'\').value) * parseInt('.$row['price'].');
                        }
                        return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button onclick="var result = document.getElementById(\'sst'.$row['item_id'].'\');
                        var cost = document.getElementById(\'price'.$row['item_id'].'\');
                        var sst = result.value;
                        if( !isNaN( sst ) &amp;&amp; sst > 0 ){
                        	result.value--;
                        	calcTotal(0, '.$row['price'].');
                        	if(result.value == 0)
                        		cost.innerHTML = '.$row['price'].';
                        	else
                        		cost.innerHTML = parseInt(document.getElementById(\'sst'.$row['item_id'].'\').value) * parseInt('.$row['price'].');
                        }
                        return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div></td>
				<td>'.$row['category'].'</td>
				<td><div id="price'.$row['item_id'].'">'.$row['price'].'</div></td></tr>';
				$items[] = $row['item_id'];
			}
			?>
			<tr>
				<td></td><td></td><td></td><td><h5>Total</h5></td>
				<td><h5><div id="total">0</div></h5></td>
			</tr>
		</tbody>
	</table>
	<?php if (isset($_SESSION['user_email'])): ?>
	<div align="right" id="checkout">
		<form action="cart.php" method="post">
			<input type="text" name="cart_shop" value="<?= $name; ?>" hidden>
			<input type="text" id="totalitems" name="items" value="" hidden>
			<input type="text" id ="totalquantities" name="quantities" value="" hidden>
			<button type="button" onclick="addToCart()" class="button button-login w-10">Add to Cart</button>
			<input type="submit" id="addCart" name="addCart" hidden>
		</form>
	</div>
	<?php endif ?>
	</div>
</div>

<script type="text/javascript">
	if(performance.navigation.type == 2){
	   location.reload(true);
	}

	var dt = document.getElementById('datesel').value;

	document.getElementById('totalitems').value = '';
	document.getElementById('totalquantities').value = '';

	document.getElementById('checkout').style.display = 'None';

	if ("<?= isset($_SESSION['user_email']); ?>" == '1') {
		document.getElementById('checkSlotBook').style.display = 'None';
	}
	else{
		document.getElementById('slotBook').style.display = 'None';
	}

	function login(){
		window.location.href = 'login.php';
	}

	function getSlots() {
		var dt = document.getElementById('datesel').value;
		window.location.href = 'store.php?shop_name='+"<?= $_GET['shop_name']; ?>"+'&datesel='+dt;
	}

	function addToCart(){
		var items = <?php echo json_encode($items); ?>;
		items.forEach(function (item){
			if (document.getElementById('sst'+item).value > 0) {
				document.getElementById('totalitems').value += item + ',';
				document.getElementById('totalquantities').value += document.getElementById('sst'+item).value + ',';
			}
		});
		document.getElementById('totalitems').value = document.getElementById('totalitems').value.slice(0, -1);
		document.getElementById('totalquantities').value = document.getElementById('totalquantities').value.slice(0, -1);
		document.getElementById('addCart').click();
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