<?php
  include 'includes/header.php';
?>
<head>
  <title>COVID-Mart | Manage</title>
</head>

  <button class="tablink" onclick="openPage('Inventory', this)" id="defaultOpen">Inventory</button>
  <button class="tablink" onclick="openPage('Shop', this)">Shop</button>
  
  <div id="Inventory" class="tabcontent">
    <h3>Inventory</h3>
    <p>Home is where the heart is..</p>
  </div>
  
  <div id="Shop" class="tabcontent">
    <h3>Shop</h3>
    <p>Some news this fine day!</p>
  </div>

  <?php
    include 'includes/footer.php';
  ?>
  
  <style type="text/css">
    .tablink {
    background-color: #555;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 50%;
  }

  .tablink:hover {
    background-color: #777;
  }

  /* Style the tab content (and add height:100% for full page content) */
  .tabcontent {
    display: none;
    padding: 100px 20px;
    height: 100%;
  }
  </style>
  <script type="text/javascript">
    function openPage(pageName, elmnt) {
      // Hide all elements with class="tabcontent" by default */
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
    
      // Remove the background color of all tablinks/buttons
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
      }
    
      // Show the specific tab content
      document.getElementById(pageName).style.display = "block";
    }
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
  </script>