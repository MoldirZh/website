<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="products_list.css" type="text/css">
<head>
</head>

<body>

  <?php 
  include 'fixed_header.php';
  ?>

<div class="content">

   <div class="side_content">
    <?php
      $link = mysqli_connect("localhost", "root", "", "project"); //connect to database

      $sql1 = "SELECT * FROM categories"; //sql
      $category = mysqli_query($link, $sql1); //perform a query

      ?> <ul style="list-style: none;"> <?php //start a list

        while ($row = mysqli_fetch_assoc ($category)) { ?><!--while the query is active-->
          <li style = "text-decoration: none; "><a href = "products_list.php?category_id=<?php echo $row['id']; ?>">
          <?php echo $row ['name']; ?></a></li><!--retrieve the category names from the database and if the user clicks on them then products of this category are shown on the main content-->
        <?php } ?>  

      </ul><!--finish the list-->

    </div>

  <div class="main_content">
     
    <?php
    $link = mysqli_connect("localhost", "root", "", "project");//connect to database

    $product = mysqli_query($link, "SELECT * FROM `products` WHERE `category_id` = " . $_GET['category_id']);//show the products of the chosen category

      //show product image, name and price
      while ($row2 = mysqli_fetch_assoc ($product)) { ?>
        <div class="product">
          <div class="pro_image" style="height: 200px; max-width: 100%; background-image: url(<?php echo $row2['image']; ?>)"></div>
          <h3> <a href = "product_page.php?id=<?php echo $row2 ['id']; ?>"> <?php echo $row2 ['name']; ?> </a> </h3>
          <h4> <?php echo $row2 ['price']; ?> </h4>
        </div>
      <?php } ?>

  </div>
</div>
  
  <?php include 'footer.php'; ?>

</body>
</html>