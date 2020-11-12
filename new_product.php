<!DOCTYPE html>
<html>
<head>
	<title>Adding a new product</title>
	<meta charset="utf-8">
</head>
<body>
<h1>Adding a new product</h1><!--adding header-->

<form method="post"><!--define a form to collect user input with post method (for security reasons)-->
  <table><!--create a table to arrange texts and inputs-->
   	<tr><td>Name<td><input name = 'name' placeholder = "Name" required><!--inputting name-->
    <tr><td>Image<td><input name = 'image' placeholder = "Image" required><!--inputting image-->
   	<tr><td>Description<td><input name = 'description' placeholder = "Description" required><!--inputting description-->
    <tr><td>Price<td><input name = 'price' placeholder = "Price" required><!--inputting price-->
    <tr><td>Category<td>
    <select> 
      <?php 
      $link = mysqli_connect("localhost", "root", "", "project");//connect to database
        $result1 = mysqli_query($link, "SELECT * FROM categories");//perform a query against the database to select data
          while ($category = mysqli_fetch_assoc($result1)) {//while there are still rows?>
            <option><a href = "new_product.php?category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></option><!--add options-->
          <?php } ?><!--stop php to add html-->
    </select>

   	<tr><td><input type='submit' name = "add" value="Add"></td><!--submit button-->
  </table>
</form>

<?php

if (isset($_POST['add'])) {

  session_start();

  $link = mysqli_connect("localhost", "root", "", "project");//connect to database

    $name = $_POST['name'];//define variable
    $image = $_POST['image'];//define variable
    $description = $_POST['description'];//define variable
    $price = $_POST['price'];//define variable
    $category_id = $_GET['category_id'];//define variable

    $result2 = mysqli_query($link, "SELECT * FROM products WHERE name = '$name' AND image = '$image' AND description = '$description' AND price = '$price' AND category_id = '$category_id'");//perform a query against the database to check if such user already exists

    if(mysqli_num_rows($result2) == 0) {//if there are no users with such name

      $query = mysqli_query($link, "INSERT INTO products (name, image, description, price, category_id) VALUES ('$name', '$image', '$description', '$price', '$category_id')");//perform a query against the database to add new data
      if ($query == true)//if query was performed successfully
        {
          header("location: home_page.php");//redirect
        }
      } 
    else {
      echo '<script language="javascript">';
      echo 'alert("There is already a product with such name")';  //showing an alert box.
      echo '</script>';
    }
  mysqli_close ($link);//close connection
}
?>

</body>
</html>