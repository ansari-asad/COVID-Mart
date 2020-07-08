<?php
  include 'includes/header.php';

  $sql = "SELECT * FROM orders WHERE shop_name='".$_SESSION['shop_name']."'";
  $runsql=$conn->query($sql);
?>
<head>
  <title>COVID-Mart | Home</title>
</head>

  <main class="site-main">
    <?php if ($runsql->num_rows > 0): ?>
      <div class="container cart_area">
        <div class="storage cart_inner table-responsive">
          <table class="table">
          <thead>
            <th scope="col">Order ID</th>
            <th scope="col">User</th>
            <th scope="col">Date</th>
            <th scope="col">Slot</th>
            <th scope="col"></th>
          </thead>
          <tbody>
            <?php
            while ($row = $runsql->fetch_assoc()) {
              echo '<tr>
              <td><h5>'.$row['order_id'].'</h5></td>
              <td>'.$row['user_email'].'</td>
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
    <?php else: ?>
      <div align="center">
      <p><br></p>
      <p>
        <h3>No Orders to be Processed!</h3>
      </p>
      <p><br></p>
      </div>
    <?php endif ?>
  </main>

<style type="text/css">
  .storage{
      width: all;
      height: 350px;
      overflow: auto;
  }
</style>

<?php
  include 'includes/footer.php';
?>