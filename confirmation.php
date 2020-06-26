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
}
if (isset($_POST['bookSlot'])) {
  $shop_name = $_POST['shop_name'];
  $date = $_POST['dateofslot'];
  $slot = $_POST['slot'];
  slotBook($conn, $shop_name, $date, $slot);
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
      <div id="slot">
        <div class="filter-bar d-flex flex-wrap align-items-center">
          <div class="sorting"><strong>Slot booked for <?php echo substr_replace( $slot, ':', 2, 0 ).' on '.$date?></strong></div>
        </div>
      </div>
      <div id="details">
        <div class="row mb-5">
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
            <div class="confirmation-card">
              <h3 class="billing-title">Order Info</h3>
              <table class="order-rable">
                <tr>
                  <td>Order number</td>
                  <td>: 60235</td>
                </tr>
                <tr>
                  <td>Date</td>
                  <td>: Oct 03, 2017</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>: USD 2210</td>
                </tr>
                <tr>
                  <td>Payment method</td>
                  <td>: Check payments</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
            <div class="confirmation-card">
              <h3 class="billing-title">Billing Address</h3>
              <table class="order-rable">
                <tr>
                  <td>Street</td>
                  <td>: 56/8 panthapath</td>
                </tr>
                <tr>
                  <td>City</td>
                  <td>: Dhaka</td>
                </tr>
                <tr>
                  <td>Country</td>
                  <td>: Bangladesh</td>
                </tr>
                <tr>
                  <td>Postcode</td>
                  <td>: 1205</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
            <div class="confirmation-card">
              <h3 class="billing-title">Shipping Address</h3>
              <table class="order-rable">
                <tr>
                  <td>Street</td>
                  <td>: 56/8 panthapath</td>
                </tr>
                <tr>
                  <td>City</td>
                  <td>: Dhaka</td>
                </tr>
                <tr>
                  <td>Country</td>
                  <td>: Bangladesh</td>
                </tr>
                <tr>
                  <td>Postcode</td>
                  <td>: 1205</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="order_details_table">
          <h2>Order Details</h2>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <p>Pixelstore fresh Blackberry</p>
                  </td>
                  <td>
                    <h5>x 02</h5>
                  </td>
                  <td>
                    <p>$720.00</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Pixelstore fresh Blackberry</p>
                  </td>
                  <td>
                    <h5>x 02</h5>
                  </td>
                  <td>
                    <p>$720.00</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Pixelstore fresh Blackberry</p>
                  </td>
                  <td>
                    <h5>x 02</h5>
                  </td>
                  <td>
                    <p>$720.00</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>Subtotal</h4>
                  </td>
                  <td>
                    <h5></h5>
                  </td>
                  <td>
                    <p>$2160.00</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>Shipping</h4>
                  </td>
                  <td>
                    <h5></h5>
                  </td>
                  <td>
                    <p>Flat rate: $50.00</p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>Total</h4>
                  </td>
                  <td>
                    <h5></h5>
                  </td>
                  <td>
                    <h4>$2210.00</h4>
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

<?php
  if (!isset($_POST['items'])) {
    echo "<script>document.getElementById('details').style.display = 'None';</script>";
  }
  include 'includes/footer.php';
?>