<div class="storage">
	<table class="table">
		<thead>
			<tr>
				<th scope="col"><input type="checkbox" id="all" name="all" onclick="toggle(this)" value="all"></th>
				<th scope="col">Item ID</th>
				<th scope="col">Name</th>
				<th scope="col">Quantity</th>
				<th scope="col">Category</th>
				<th scope="col">Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$shop = str_replace(' ', '', $_SESSION['shop_name']);
			$sql = "SELECT * FROM $shop";
			$runsql = $conn->query($sql);
			while ($row = $runsql->fetch_assoc()) {
				echo '<tr>
				<td><input type="checkbox" name="chkbox" id="'.$row['item_id'].'" onclick="modifiable()" value="'.$row['item_id'].'"></td>
				<td>'.$row['item_id'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$row['quantity'].'</td>
				<td>'.$row['category'].'</td>
				<td>'.$row['price'].'</td>
				</tr>';
			}
			?>
		</tbody>
	</table>
</div>

<div class="filter-bar d-flex flex-wrap align-items-center">
	<button type="submit" id="modify" name="modify" class="button button-login w-10">Modify</button>&nbsp;&nbsp;&nbsp;&nbsp;
	<button type="submit" id="delete" name="delete" class="button button-login w-10">Delete</button>
</div>

<form action="addItem.php" method="post">
	<!-- <div class="table-responsive align-items-center filter-bar ex1"> -->
	<table class="table">
		<tr>
			<td><input type="text" name="name" placeholder="Name" required></td>
			<td><div class="product_count">
    		    <input type="text" name="quantity" id="sst" maxlength="12" min="1" value="1" title="Quantity" class="input-text qty" required>
    		</div></td>
    		<td><div class="dropdown">
    			<select name="category">
    				<?php
    				$email = $_SESSION['shop_email'];
    				$sql = "SELECT shop_cuisine FROM shops WHERE shop_email = '$email'";
    				$runsql=$conn->query($sql);
					$row = $runsql->fetch_assoc();
					foreach (explode(",", $row['shop_cuisine']) as $category) {
						echo "$category";
						echo "<option value='$category'>$category</option>";
					}
    				?>
    			</select>
    		</div></td>
    		<td><input type="number" name="price" min="1" placeholder="Price" required></td>
    		<td><input type="text" name="shop" value="<?php echo $_SESSION['shop_name']; ?>" hidden></td>
    		<td align="right"><button type="submit" id="addItem" name="addItem" class="button button-login w-10">Add Item</button></td>
    	</tr>
    </table>
    <!-- </div> -->
</form>

<style type="text/css">
	div.storage{
  		width: all;
  		height: 300px;
  		overflow: scroll;
	}
	input[type=text],input[type=number], select {
  width: 60%;
  padding: 7px 10px;
  margin: 2px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
</style>

<script type="text/javascript">
	function toggle(source) {
	  var checkboxes = document.getElementsByName('chkbox');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
	    checkboxes[i].checked = source.checked;
	  }
	  modifiable();
	}

	function modifiable(){
		if(document.querySelectorAll('input[name="chkbox"]:checked').length >= 2){
			document.getElementById('modify').disabled = true;
		}
	}
</script>