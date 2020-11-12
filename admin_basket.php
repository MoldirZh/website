<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="basket.css" type="text/css">
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
      $sql2 = "SELECT * FROM basket"; //sql
      $basket = mysqli_query($link, $sql2); //perform a query
    ?>
     
    <table style="max-width: 100%;"><!--create a table-->
      <th>User</th>
      <th>Product</th>
      <th>Quantity</th>
      <th>Remove</th>
      <?php 
      while ($row = mysqli_fetch_assoc ($basket)) { 
        
        $sql3 = "SELECT id, name FROM `products` WHERE `id` = '{$row ['product_id']}'";
        $query = mysqli_query($link, $sql3);

        $product = mysqli_fetch_assoc ($query);
        ?><!--while the query is active-->

          <tr>
            <td><a href = "account_basket.php?username=<?php echo $row['username']; ?>"><?php echo $row['username'] ?></a></td>
            <td><a href = "product_page.php?id=<?php echo $product['id']; ?>"><?php echo $product ['name']; ?></a></td>
            <td><?php echo $row ['quantity']; ?></td>
            <td><form method = "post"><input type = "submit" name = "remove" value = "Удалить"></form></td>
          </tr>

      <?php } 
        if (isset($_POST['remove'])) {
          $sql2 = "DELETE FROM `basket` WHERE `order_id` = '{$row['order_id']}'";
          $query = mysqli_query($link, $sql2);
        }
      ?>  
    </table><!--finish the list-->

  </div>
</div>
  
  <?php include 'footer.php'; ?>

</body>
</html>