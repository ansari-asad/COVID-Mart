<?php
  include 'includes/header.php';
?>
<head>
  <title>COVID-Mart | Cart</title>
</head>  

<?php
if (isset($_POST['addCart'])) {
  $_SESSION['cart_shop'] = $_POST['cart_shop'];
  $_SESSION['items'] = $_POST['items'];
  $_SESSION['quantities'] = $_POST['quantities'];
}
?>

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

<?php if (!isset($_SESSION['items'])): ?>
<div align="center">
<p><br></p>
<p>
  <h3>No items in Cart!</h3>
</p>
<p><br></p>
</div>
<?php else: ?>

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
<div class="container cart_area">
  <div class="cart_inner table-responsive">
    <table class="table" id="cartTable">
    <thead>
      <th scope="col">Item ID</th>
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Category</th>
      <th scope="col">Price (₹)</th>
    </thead>
    <tbody>
      <?php
      $shop = str_replace(' ', '', $_SESSION['cart_shop']);
      $items = $_SESSION['items'];
      $items = explode(',', $items);
      $quantities = $_SESSION['quantities'];
      $quantities = explode(',', $quantities);
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
  <div>
    <form action="confirmation.php" method="post">
      <div class="filter-bar d-flex flex-wrap align-items-center">
        <div class="sorting">
          <select name="dateofslot" onchange="getSlots()" id="datesel">
            <?php
            $sql = "SELECT DISTINCT(STR_TO_DATE(`date`, '%d/%m/%Y')) AS slot_dates FROM slots WHERE shop_name = '".$_SESSION['cart_shop']."' ORDER BY slot_dates";
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
            $sql = "SELECT * FROM slots WHERE shop_name = '".$_SESSION['cart_shop']."' AND `date` = '$dt'";
            $runsql = $conn->query($sql);
            while ($row = $runsql->fetch_assoc()) {
              echo '<option value="'.$row['slot'].'">'.substr_replace( $row['slot'], ':', 2, 0 ).'</option>';
            }
            ?>
          </select>
        </div>
        <input type="text" name="shop_name" value="<?php echo $_SESSION['cart_shop']; ?>" hidden>
        <input type="text" name="items" id="totalitems" value="" hidden>
        <input type="text" name="quantities" id="totalquantities" value="" hidden>
        <div class="sorting">
          <button type="button" onclick="book()" style="align-content: right;" class="button button-login w-10">Book Items & Slot</button>
          <input type="submit" id="bookItemSlot" name="bookItemSlot" hidden>
        </div>
      </div>
    </form>
  </div>
</div>
<!--================End Cart Area =================-->

<script type="text/javascript">
  function getSlots() {
    var dt = document.getElementById('datesel').value;
    window.location.href = 'cart.php?datesel='+dt;
  }
  function book() {
    for (var i = 1; i < document.getElementById("cartTable").rows.length; i++) {
      document.getElementById('totalitems').value += document.getElementById("cartTable").rows[i].cells[0].textContent + ',';
      document.getElementById('totalquantities').value += document.getElementById("cartTable").rows[i].cells[2].textContent + ',';
    }
    document.getElementById('totalitems').value = document.getElementById('totalitems').value.slice(0, -2);
    document.getElementById('totalquantities').value = document.getElementById('totalquantities').value.slice(0, -2);
    document.getElementById('bookItemSlot').click();
  }
</script>

<?php endif ?>
<?php
  include 'includes/footer.php';
?>