<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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

      if (!empty ($_SESSION['uname'])) { //if the user is logged in
        $account = mysqli_query($link, "SELECT * FROM `users` WHERE `username` = '{$_SESSION['uname']}'");
      }//perform a query to sql to find the current user
      if (!empty ($_SESSION['adminname'])) { //if the admin is logged in
        $account = mysqli_query($link, "SELECT * FROM `users` WHERE `username` = '{$_SESSION['adminname']}'");
      }//perform a query to sql to find the current admin

        if (mysqli_num_rows ($account) <= 0 ) {//if no user is found
          echo "No account"; //a message
        } else {
          $row = mysqli_fetch_assoc ($account); //retrieve the data?> 
            <div class="account">
              <div class = "name"><h3>Username: <b><?php echo $row['username']; //show a username?></b></h3>
                <div id = "update1" style = "display: none; ">
                  <form action = "update_account.php" method="post"><!--name update button-->
                    <input name ='uname' pattern="[A-Za-z]{5,11}" title="Username should be in letters and more than 5 and less than 11" placeholder= "username" required><!--label for the new name-->
                    <input type='submit' value="Update"><!--button to post the form-->
                  </form>
                </div>
                <input type='submit' id="update_button1" value="Update" onclick="updates1()"><!--a button to display the post button and a label-->
              </div>
              <div class = "email"><h4>Email: <b><?php echo $row['email']; //show an email?></b></h4>
                <div id = "update2" style = "display: none; ">
                  <form action = "update_account.php" method="post">
                    <input name ='email' placeholder= "email" pattern="[?=.*[@]]" title="Incorrect email format" required>
                    <input type='submit' value="Update">
                  </form>
                </div>
                <input type='submit' id="update_button2" value="Update" onclick="updates2()">
              </div>
              <div class = "address"><h4>Address: <b><?php echo $row['address']; //show the address?></b></h4>
                <div id = "update3" style = "display: none; ">
                  <form action = "update_account.php" method="post">
                    <input name ='address' placeholder= "address" required>
                    <input type='submit' value="Update">
                  </form>
                </div>
                <input type='submit' id="update_button3" value="Update" onclick="updates3()">
              </div>
              <div class = "telnumber"><h4>Telephone Number: <b><?php echo $row['telnumber']; //show the telephone number?></b></h4>
                <div id = "update4" style = "display: none; ">
                  <form action = "update_account.php" method="post">
                    <input name ='telnumber' placeholder= "telnumber" pattern="^[ 0-9]+$" title="Incorrect telephone number format" required>
                    <input type='submit' value="Update">
                  </form>
                </div>
                <input type='submit' id="update_button4" value="Update" onclick="updates4()">
              <div class = "password"><h5>Password: <b><?php echo $row['password']; //a current password?></b></h5>
                <div id = "update5" style = "display: none; ">
                  <form action = "update_account.php" method="post">
                    <input type="password" name="password" pattern=".{4,}" title="Password must be more than 4 characters" placeholder="password" onchange="form.cpassword.pattern=this.value;" required>
                    <input type='submit' value="Update">
                  </form>
                </div>
                <input type='submit' id="update_button5" value="Update" onclick="updates5()">
              </div>
            </div><br>

            <script type="text/javascript">
              function updates1() {
                document.getElementById('update1').style.display = 'block';//show the label
                document.getElementById('update_button1').style.display = 'none';//hide the button that shows the label
              }
              function updates2() {
                document.getElementById('update2').style.display = 'block';
                document.getElementById('update_button2').style.display = 'none';
              }
              function updates3() {
                document.getElementById('update3').style.display = 'block';
                document.getElementById('update_button3').style.display = 'none';
              }
              function updates4() {
                document.getElementById('update4').style.display = 'block';
                document.getElementById('update_button4').style.display = 'none';
              }
              function updates5() {
                document.getElementById('update5').style.display = 'block';
                document.getElementById('update_button5').style.display = 'none';
              }
            </script>

        <?php } ?>

</div>
</div>

<?php include 'footer.php'; //include the footer?>

</body>
</html>