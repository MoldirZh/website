<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="product_page.css" type="text/css">
<head>
</head>
<body>

<?php include 'fixed_header.php'; ?>

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

    //get the data from the database where product id is the same as the id of the product that was clicked before
    $product = mysqli_query($link, "SELECT * FROM `products` WHERE `id` = ". (int) $_GET['id']);

      if (mysqli_num_rows ($product) <= 0 ) {
        echo "This product does not exist";
      } else {
        $row = mysqli_fetch_assoc ($product); //while retrieving the data?>
          <div class="product">
            <div class = "pro_name"><h3><?php echo $row['name']; //name?></h3></div>
            <div class = "pro_price"><img src = "<?php echo $row['image']; //image?>" style = "max-width: 100%;"></div>
            <div class = "pro_price"><h4><?php echo $row['price']; //price?></h4></div>
            <p><?php echo $row['description']; //description?></p><br>
              <?php if (!empty($_SESSION['uname'])) { ?>
                <form method= "post">
                <input type = "text" name = "quantity" placeholder = "quantity">
                <input type = "submit" name = "basket" value = "Добавить в корзину">
              </form>
              <?php }?>
          </div>
        <?php } 
          if (isset($_POST['basket'])) {
            $user = $_SESSION['uname'];
            $product = $_GET['id'];
            $quantity = $_POST['quantity'];

            $query = "INSERT INTO `basket` (username, product_id, quantity) VALUES ('$user', '$product', '$quantity')";
            $basket = mysqli_query($link, $query);
          }
        ?> <br>

      <!--show comments for this product-->
      <div class="comment">
        <h3>Комментарии</h3>
        
        <?php 
        //user has to log in to add reviews
        //admin cannot add them
        if (!isset($_SESSION['uname']) && !isset($_SESSION['adminname'])) { ?>
          <div class = "review_login">
            <h5>Войдите в аккаунт, чтобы добавить комментарий</h5>
          </div>
        <?php }
        //if user has logged in
        if (!empty($_SESSION['uname'])) { ?>
          <h5>Добавить комментарий</h5>
          <div class = "review_add">
            <form method = "post">
              <input name = "review_text" placeholder = "Добавить комментарий"><br><br>
                <input type="submit" name = "add" value="Добавить">
            </form>
            <?php 
              if (isset($_POST['add'])) { //if the add button was clicked
                //define variables
                $review = $_POST['review_text'];
                $product_id = $row['id'];
                $user = $_SESSION['uname'];
                //insert a new review
                $query = mysqli_query($link, "INSERT INTO `reviews` (review, product_id, user, today_date) VALUES ('$review', '$product_id', '$user', date)");
              } 
            ?>
          </div>
        <?php } ?>

        <br> <?php
        //retrieve the data from the reviews table where the product id is the sam as the id of this product
        $sql3 = "SELECT * FROM `reviews` WHERE `product_id` = " . $row['id'];
        $reviews = mysqli_query ($link, $sql3);
        if (mysqli_num_rows($reviews) <=0) { ?>
          <div class = "review_show">
            No reviews
          </div>  
        <?php } else {
          while ($review = mysqli_fetch_assoc($reviews)) { ?>
            <div class = "review">
              <div class = "review_user"><b><?php echo $review ['user']; ?></b></div>
              <div class = "review_date"><?php echo $review ['today_date'] ?></div><br>
              <div class = "review_text"><?php echo $review ['review'] ?></div>
            </div>
          <?php }
        }
        ?>   
      </div>

  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>