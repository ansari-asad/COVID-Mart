<?php
  include 'includes/header.php';
?>
<head>
  <title>COVID-Mart | Cart</title>
</head>

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Shopping Cart</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

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

<!--================Cart Area =================-->
<div class="container cart_area cart_inner table-responsive">
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
      $shop = $_POST['shop'];
      $items = $_POST['items'];
      $items = explode(',', $items);
      array_pop($items);
      $quantities = $_POST['quantities'];
      $quantities = explode(',', $quantities);
      array_pop($quantities);
      $sql = "SELECT * FROM $shop WHERE item_id in (".implode(', ', $items).")";
      $runsql = $conn->query($sql);
      $total = 0;
      while ($row = $runsql->fetch_assoc()) {
        echo '<tr>
        <td>'.$row['item_id'].'</td>
        <td>'.$row['name'].'</td>
        <td><h5>'.$quantities[array_search($row['item_id'], $items)].'</h5></td>
        <td>'.$row['category'].'</td>
        <td><h5>'.$row['price'] * $quantities[array_search($row['item_id'], $items)].'</h5></td>
        </tr>';
        $total += $row['price'] * $quantities[array_search($row['item_id'], $items)];
      }
      ?>
        <tr>
          <td></td><td></td><td></td><td><h5>Total</h5></td>
          <td><h5><?= $total; ?></h5></td>
        </tr>
      </tbody>
    </table>
</div>
<!--================End Cart Area =================-->

<?php
  include 'includes/footer.php';
?>