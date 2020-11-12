<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="new_products.css" type="text/css">
<head>
</head>
<body>

<?php include 'fixed_header.php';?>

<div class="content">
  <div class="side_content">
    <?php
      $link = mysqli_connect("localhost", "root", "", "project"); //connect to database

      $sql1 = "SELECT * FROM categories"; //sql
      $category = mysqli_query($link, $sql1); //perform a query

      ?> <ul> <?php //start a list

        while ($row = mysqli_fetch_assoc ($category)) { ?><!--while the query is active-->
          <li style = "text-decoration: none; "><a href = "products_list.php?category_id=<?php echo $row['id']; ?>">
          <?php echo $row ['name']; ?></a></li><!--retrieve the category names from the database and if the user clicks on them then products of this category are shown on the main content-->
        <?php } ?>  

      </ul><!--finish the list-->

    </div>

      <div class="main_content">
         
        <?php

        $sql2 = 'SELECT name, price, image FROM `products` ORDER BY `id` DESC LIMIT 10';
        $product = mysqli_query($link, $sql2);//show the products that were added recently

        while ($row = mysqli_fetch_assoc ($product)) { //while the data is being retrieved?>
          <div class="product">
            <div class="pro_image" style="height: 200px; background-image: url(<?php echo $row['image']; ?>)"></div><!--show the image-->
            <h3> <a href = "product_page.php?id=<?php echo $row ['id']; ?>"> <?php echo $row ['name']; ?> </a> </h3><!--name of the product-->
            <h4> <?php echo $row ['price']; ?> </h4><!--price of the product-->
          </div>
        <?php } ?>

      </div>

</div>

<?php include 'footer.php'; //include the footer?>

</body>
</html>