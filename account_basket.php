<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="account.css" type="text/css">
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

    //get the data from the database where account id is the same as the id of the account that was clicked before
    $account = mysqli_query($link, "SELECT * FROM `users` WHERE `username` = '{$_GET['username']}'");

      if (mysqli_num_rows ($account) <= 0 ) {
        echo "This account does not exist";
      } else {
        $row = mysqli_fetch_assoc ($account); //while retrieving the data?>
          <div class="account">
              <div class = "name"><h3>Username: <b><?php echo $row['username']; //show a username?></b></h3></div>
              <div class = "email"><h4>Email: <b><?php echo $row['email']; //show an email?></b></h4></div>
              <div class = "address"><h4>Address: <b><?php echo $row['address']; //show the address?></b></h4></div>
              <div class = "telnumber"><h4>Telephone Number: <b><?php echo $row['telnumber']; //show the telephone number?></b></h4></div>
              </div>
          </div>
         <?php } ?> 

  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>