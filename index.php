<?php
  include 'includes/header.php';
  if (isset($_SESSION['user_email'])) {
    $sql = "SELECT * FROM orders WHERE user_email='".$_SESSION['user_email']."'";
    $runsql=$conn->query($sql);
  }
?>
<head>
  <title>COVID-Mart | Home</title>
</head>

  <main class="site-main">
    
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/home/hero-banner.png" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
            <h4>BOOK Your Slot Now</h4>
              <h1 style="font-size:300%;">SHOP NOW SHOP SAFE</h1>
              <p>An interface that benefits local shops and citizens alike, ensuring the much needed social distancing.</p>
              <a class="button button-hero" href="category.php">Browse Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->

    <?php if (isset($_SESSION['user_email']) and $runsql->num_rows > 0): ?>
      <div class="container cart_area">
        <div class="storage cart_inner table-responsive">
          <table class="table">
          <thead>
            <th scope="col">Order ID</th>
            <th scope="col">Shop</th>
            <th scope="col">Date</th>
            <th scope="col">Slot</th>
            <th scope="col"></th>
          </thead>
          <tbody>
            <?php
            while ($row = $runsql->fetch_assoc()) {
              echo '<tr>
              <td><h5>'.$row['order_id'].'</h5></td>
              <td>'.$row['shop_name'].'</td>
              <td><h5>'.$row['date'].'</h5></td>
              <td><h5>'.substr_replace( $row['slot'], ':', 2, 0 ).'</h5></td><td><center>';
              if (isset($row['order_items'])) {
                echo '<a class="button button-coupon" href="order.php?id='.$row['order_id'].'">View Order</a>';
              }
              else {
                echo 'No items booked';
              }
              echo '</center></td></tr>';
            }
            ?>
          </tbody>
          </table>
        </div>
      </div>
    <?php endif ?>

</main>
<?php
  include 'includes/footer.php';
?>