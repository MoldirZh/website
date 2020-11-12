<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="fixed_header.css" type="text/css">
<head>
</head>
<body>

<!--links to the instagram page-->
<div class="top">
  <a href="https://www.instagram.com/taraz_korean_cosmetics/?hl=ru"><img src="instagram.png" alt="Instagram" width="100" height="26"></a>
  <a href="https://www.instagram.com/careprost_taraz_meruert/?hl=ru"><img src="instagram.png" alt="Instagram" width="100" height="26"></a>

  <?php 
  session_start();

  //if the user is not logged in then show the link to login page
  if (!isset($_SESSION['uname']) && !isset($_SESSION['adminname'])) { ?>
    <a href="login.php" class = "text">Log in</a>
  <?php }

  //if the user is logged in the show the link to account page
  if (!empty ($_SESSION['uname'])) { ?>
      <a href = "account.php" class = "text">My Account</a>
      <a href = "user_basket.php" class = "text">Basket</a>
  <?php } 

  //if the admin is logged in then show more options
  if (!empty ($_SESSION['adminname'])) { ?>
      <a href = "new_product.php" class = "text">Add Product</a>
      <a href = "new_category.php" class = "text">Add Category</a>
      <a href = "account.php" class = "text">My Account</a>
      <a href = "admin_basket.php" class = "text">Basket</a>
  <?php }

  //if either user or admin is logged in then show the logout link 
  if (isset($_SESSION['uname']) || isset($_SESSION['adminname'])) { ?>
    <a href = "logout.php" class="text">Log out</a>
  <?php }

  ?>
  
</div>

<!--a logo and the name of the company which redirect to homepage-->
<div class="header">
    <a href="home_page.php"><img src="panda_header.png" alt="panda" width="47" height="50">Мир Корейской косметики</a>
</div>

<!--fast redirect-->
<div class="header_navigation">
  <a href="new_products.php">Новинки</a>
  <a href="about.php">О компании</a>
  <a href="delivery.php">Доставка</a>
</div>

</body>
</html> 