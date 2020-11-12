<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<h1>Login</h1><!--adding header-->
<div class="login">
  <form method="post" class="login-content"> <!--define a form to collect user input with post method (for security reasons)-->
    <table><!--create a table to arrange texts and inputs-->
   	  <tr><td> Login <td><input name ='name' placeholder= "username" required><!--inputting username-->
   	  <tr><td> Password<td><input type="password" name="password" placeholder="password" required><!--inputting password-->
   	  <tr><td><input type='submit' name = "login" value="login"></td><!--submit button-->
   	  <tr><td>Not registered?<a href = "sign_up.php">Register</a></td>
    </table>
  </form>

  <?php
    if (isset($_POST['login'])) {
      $link = mysqli_connect("localhost", "root", "", "project");//connect to database

      $name = $_POST ['name'];//define a name variable
      $password = $_POST ['password'];//define a password variable

      $result = mysqli_query($link, "SELECT * FROM `users` WHERE `username` = '$name' AND password = '$password'");//perform a query against the database to compare the data from db and inputted data

        if(mysqli_num_rows($result) == 1) {//if there is a match
            
          $row = mysqli_fetch_array ($result);//get a data from database
          $usertype = $row['usertype'];//define a variable

          session_start();
          if ($usertype == 'user') {//if the current user is the user 
            $_SESSION['uname'] = $_POST['name'];//session variable is set to the user to style the header
          }
          if ($usertype == 'admin') {//if the current user is the admin 
            $_SESSION['adminname'] = $_POST['name'];//session variable is set to the admin name to style the header
          }
          
          header( "Location: home_page.php" );//redirect
        }
        else
        {
          echo '<script language="javascript">';
          echo 'alert("Incorrect login or password")';  //showing an alert box.
          echo '</script>';
        }

      mysqli_close ($link);//close a connection
   }
  ?>
</div>
</body>
</html>