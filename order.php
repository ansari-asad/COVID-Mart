<?php
  include 'includes/header.php';

  $id = $_GET['id'];
  $sql = "SELECT * FROM orders WHERE order_id=".$id;
  $runsql=$conn->query($sql);
  $row = $runsql->fetch_assoc();
?>
<head>
  <title>COVID-Mart | Order Details</title>
</head>

<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Order Details</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
			            <ol class="breadcrumb">
			              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
			              <li class="breadcrumb-item active" aria-current="page">Order Details</li>
			            </ol>
			        </nav>
				</div>
			</div>
    	</div>
	</section>
<!-- ================ end banner area ================= -->

<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
    <div class="container">
      <div>
        <div class="row mb-5">
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
          </div>
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
            <div class="confirmation-card">
              <h3 class="billing-title">Order Info</h3>
              <table class="order-rable">
                <tr>
                  <td>Order number</td>
                  <td>: <?= $id ?></td>
                </tr>
                <tr>
                  <td>Shop Name</td>
                  <td>: <?= $row['shop_name'] ?></td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>: <?= $row['date'] ?></td>
                </tr>
                <tr>
                  <td>Slot</td>
                  <td>: <?= substr_replace( $row['slot'], ':', 2, 0 ) ?></td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td id="total1"></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="order_details_table">
          <h2>Order Details</h2>
          <div class="table-responsive">
            <table class="table" id="orderTable">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Sub-Total (₹)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $shop = str_replace(' ', '', $row['shop_name']);
                $items = explode(',', $row['order_items']);
                $quantities = explode(',', $row['quantity']);
                $sql = "SELECT * FROM $shop WHERE item_id in (".implode(', ', $items).")";
                $runsql = $conn->query($sql);
                while ($row = $runsql->fetch_assoc()) {
                  echo '<tr>
                  <td>'.$row['name'].'</td>
                  <td><h5>'.$quantities[array_search($row['item_id'], $items)].'</h5></td>
                  <td><p>'.$row['price'] * $quantities[array_search($row['item_id'], $items)].'</p></td>
                  </tr>';
                }
                ?>
                <tr>
                  <td>
                    <h4>Total</h4>
                  </td>
                  <td>
                    <h5></h5>
                  </td>
                  <td>
                    <h4 id="total2"></h4>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>
<!--================End Order Details Area =================-->

<script type="text/javascript">
  var total = 0;
  for (var i = 1; i < document.getElementById("orderTable").rows.length - 1; i++) {
    total += parseInt(document.getElementById("orderTable").rows[i].cells[2].textContent);
  }
  document.getElementById('total1').innerHTML = ': ₹' + total;
  document.getElementById('total2').innerHTML = '₹' + total;
</script>

<?php
  include 'includes/footer.php';
?>