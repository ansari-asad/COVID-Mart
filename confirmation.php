<?php
  include 'includes/header.php';
?>
<head>
  <title>COVID-Mart | Confirmation</title>
</head>

<?php
function slotBook($conn, $shop_name, $date, $slot){
  // Decrement available slots
  $sql = "UPDATE `slots` SET `No of available`=`No of available`-1 WHERE shop_name='$shop_name' AND `date`='$date' AND slot='$slot'";
  if (!($runsql = $conn->query($sql))) {
    echo "<script>alert('Error booking slot!');</script>";
    echo "<script>window.location.href = 'store.php?shop_name="+$shop_name+"'</script>";
  }

  // Delete empty slots
  $sql = "DELETE FROM `slots` WHERE `No of available` = 0";
  if (!($runsql = $conn->query($sql))) {
    echo "<script>alert('Error booking slot!');</script>";
    echo "<script>window.location.href = 'store.php?shop_name="+$shop_name+"'</script>";
  }

  // Save booked slot
  $sql = "INSERT INTO orders(user_email, shop_name, `date`, slot) VALUES('".$_SESSION['user_email']."', '$shop_name', '$date', '$slot')";
  if (!($runsql = $conn->query($sql))) {
    echo "<script>alert('Error booking slot!');</script>";
    echo "<script>window.location.href = 'store.php?shop_name="+$shop_name+"'</script>";
  }

  // Return unique id of last booked slot
  $sql = "SELECT LAST_INSERT_ID() AS last_id";
  $runsql = $conn->query($sql);
  $row = $runsql->fetch_assoc();
  return $row['last_id'];
}
if (isset($_POST['bookSlot'])) {
  $shop_name = $_POST['shop_name'];
  $date = $_POST['dateofslot'];
  $slot = $_POST['slot'];
  slotBook($conn, $shop_name, $date, $slot);
}
if (isset($_POST['bookItemSlot'])) {
  $shop_name = $_POST['shop_name'];
  $date = $_POST['dateofslot'];
  $slot = $_POST['slot'];
  $items = $_POST['items'];
  $quantities = $_POST['quantities'];
  $id = slotBook($conn, $shop_name, $date, $slot);
}
?>

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Order Confirmation</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
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
      <p class="text-center billing-alert">Thank you. Your order has been received.</p>
      <div>
        <div class="filter-bar d-flex flex-wrap align-items-center">
          <div class="sorting"><strong>Slot booked for <?php echo substr_replace( $slot, ':', 2, 0 ).' on '.$date?></strong></div>
        </div>
      </div>
      <?php if (isset($_POST['items'])): ?>
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
                  <td>: <?= $shop_name ?></td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>: <?= $date ?></td>
                </tr>
                <tr>
                  <td>Slot</td>
                  <td>: <?= substr_replace( $slot, ':', 2, 0 ) ?></td>
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
                $shop = str_replace(' ', '', $shop_name);
                $items = explode(',', $items);
                $quantities = explode(',', $quantities);
                $sql = "SELECT * FROM $shop WHERE item_id in (".implode(', ', $items).")";
                $runsql = $conn->query($sql);
                $costs = '';
                while ($row = $runsql->fetch_assoc()) {
                  echo '<tr>
                  <td>'.$row['name'].'</td>
                  <td><h5>'.$quantities[array_search($row['item_id'], $items)].'</h5></td>
                  <td><p>'.$row['price'] * $quantities[array_search($row['item_id'], $items)].'</p></td>
                  </tr>';
                  $costs .= $row['price'].',';
                }
                $costs = substr($costs, 0, -1);
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
      <?php endif ?>
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
if (isset($_POST['bookItemSlot'])) {
  foreach ($items as $index => $item) {
    $sql = "UPDATE $shop SET quantity = quantity - $quantities[$index] WHERE item_id = $item";
    if (!($runsql = $conn->query($sql))) {
      echo "<script>alert('Error booking slot!');</script>";
      echo "<script>window.location.href = 'cart.php'</script>";
    }
  }
  echo "<br>";
  $items = implode(', ', $items);
  $quantities = implode(', ', $quantities);
  $sql = "UPDATE orders SET order_items = '$items', quantity = '$quantities', cost = '$costs' WHERE order_id = $id";
  if (!($runsql = $conn->query($sql))) {
    echo "<script>alert('Error booking slot!');</script>";
    echo "<script>window.location.href = 'cart.php'</script>";
  }
  unset($_SESSION['cart_shop']);
  unset($_SESSION['items']);
  unset($_SESSION['quantities']);
}
?>

<?php
  include 'includes/footer.php';
?>