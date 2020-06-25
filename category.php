<?php
  include 'includes/header.php';
  include 'core/init.php';
  
  $criteria = 'all';
  if (isset($_GET['criteria'])) {
    $criteria = $_GET['criteria'];
  }
  else{
    echo "<script>window.location.href = 'category.php?criteria=all'</script>";
  }
	
	/*$sql = "SELECT * from shops";
	$result = mysqli_query($conn,$sql);
	$id = $criteria;
	$ans = array();
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$cuisineAvail=$row['shop_cuisine'];
			$ans=explode(',',$cuisineAvail);
			for ($i=0; $i < sizeof($ans); $i++) { 
				if($ans[$i] == $criteria){
					$id.='shop_id = "'.$row['shop_id'].'" OR ';
				}
			}
		}
	}*/
	if($criteria == 'all'){
    $sqlRest="SELECT * FROM shops";
	}else{
    $criteria = str_replace(" and "," & ",$criteria);
    $sqlRest="SELECT * FROM shops WHERE shop_cuisine LIKE '%".$criteria."%'";
    /*echo $sqlRest;
    exit();*/
	}
	$result = mysqli_query($conn,$sqlRest);
?>
<head>
  <title>COVID-Mart | Category</title>
</head>

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Shop From Stores</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">List of Stores</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->


	<!-- ================ category section start ================= -->		  
  <section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Browse Categories</div>
            <ul class="main-categories">
              <li class="common-filter">
                <form action="#">
                  <ul>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Medical')" type="radio" id="Medical" name="category"><label for="Medical"> Medical</label></li>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Fruits and Vegetables')" type="radio" id="Fruits and Vegetables" name="category"><label for="Fruits and Vegetables">Fruits & Vegetables</label></li>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Household')" type="radio" id="Household" name="category"><label for="Household">Household</label></li>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Packaged Food')" type="radio" id="Packaged Food" name="category"><label for="Packaged Food">Packaged Food</label></li>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Eggs and Meat')" type="radio" id="Eggs and Meat" name="category"><label for="Eggs and Meat">Eggs & Meat</label></li>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Beauty and Hygiene')" type="radio" id="Beauty and Hygiene" name="category"><label for="Beauty and Hygiene">Beauty & Hygiene</label></li>
                    <li class="filter-list"><input class="pixel-radio" onclick="cuisinefilter('Others')" type="radio" id="Others" name="category"><label for="Others">Others</label></li>
                  </ul>
                </form>
              </li>
            </ul>
          </div>

        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row">
              
              <?php
                  $c=0;
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result)){
                      $name =  $row['shop_name'];
                      $image = $row['shop_image'];
                      $rating = $row['shop_rating'];
                      $cuisine = $row['shop_cuisine'];
                      $c++;
                      $offset= '<div class="col-md-6 col-lg-4">
                                  <div class="card text-center card-product">
                                    <div class="card-product__img">
                                      <img class="card-img" src="'.$image.'" alt="">
                                      <ul class="card-product__imgOverlay">
                                        <li><button><i class="ti-search"></i></button></li>
                                        <li><button><i class="ti-shopping-cart"></i></button></li>
                                        <li><button><i class="ti-heart"></i></button></li>
                                      </ul>
                                    </div>
                                    <div class="card-body">
                                      <p>'.$cuisine.'</p>
                                      <h4 class="card-product__title"><a href="store.php?shop_name='.$name.'">'.$name.'</a></h4>
                                    </div>
                                  </div>
                                </div>';
                      echo $offset;
                    }
                  }
			        ?>
                
              </div>
              
            </div>
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
	<!-- ================ category section end ================= -->		  

<script type="text/javascript">
  var criteria = "<?= $_GET['criteria']; ?>";
  document.getElementById(criteria).checked = true;

  function cuisinefilter(val){
    window.location.href = "category.php?criteria="+val;
  }
</script>
	
<?php
  include 'includes/footer.php';
?>