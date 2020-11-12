<!DOCTYPE html>
<html>
<head>
	<title>Adding category</title>
	<meta charset="utf-8">
</head>
<body>
<h1>Adding category</h1><!--adding header-->
<form method="post"><!--define a form to collect user input with post method (for security reasons)-->
  <table><!--create a table to arrange texts and inputs-->
   	<tr><td>Name<td><input name = 'name' placeholder = "Name" required><!--inputting name-->
   	<tr><td><input type='submit' name = "add" value="Add"></td><!--submit button-->
  </table>
</form>

<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "project");//connect to database

if (isset($_POST['add'])) {

  $name = $_POST['name'];//define variable
	    
  $result = mysqli_query($link, "SELECT * FROM `categories` WHERE `name` = '$name'");//perform a query against the database to check if such user already exists

	if(mysqli_num_rows($result) == 0) {//if there are no users with such name

	  $query = mysqli_query($link, "INSERT INTO `categories` (name) VALUES ('$name')");//perform a query against the database to add new data
	    if ($query == true)//if query was performed successfully
	      {
	        header("location: home_page.php");//redirect
		  }
	} else {
        echo '<script language="javascript">';
        echo 'alert ("There is already a category with such name")';  //showing an alert box.
        echo '</script>';
	  }
	mysqli_close ($link);//close connection
}
?>

</body>
</html>