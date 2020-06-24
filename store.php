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
						echo '<option value="'.$row['slot'].'">'.$row['slot'].'</option>';
					}
					?>
				</select>
			</div>
			<div class="sorting">
				<button type="submit" name="bookSlot" style="align-content: right;" class="button button-login w-10">Book Slot</button>
			</div>
		</div>
	</form>

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
				echo '<tr>
				<td>'.$row['item_id'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$row['quantity'].'</td>
				<td>'.$row['category'].'</td>
				<td>'.$row['price'].'</td>
				<td></td>
				</tr>';
			}
			?>
		</tbody>
	</table>
	</div>
</div>

<script type="text/javascript">
	var dt = document.getElementById('datesel').value;

	function getSlots() {
		var dt = document.getElementById('datesel').value;
		window.location.href = 'store.php?shop_name='+"<?= $_GET['shop_name']; ?>"+'&datesel='+dt;
	}
</script>

<?php
	include 'includes/footer.php';
?>