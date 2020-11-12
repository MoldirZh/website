<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="about.css" type="text/css">
<head>
</head>
<body>

<?php include 'fixed_header.php';?> <!--include a header-->

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

    <div class = "main_content">

      <div id="googleMap" style="max-width:100%;height:400px;"></div><!--add a google map-->

      <script>
      function myMap() {//start a function
      var mapProp= {//write a properties of the map
          center:new google.maps.LatLng(42.884530, 71.350309),
          zoom:15,
      };
      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

      }//display the map
      </script>

      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4X2v2eFgy0Dz_LLqn94yC_60ksElead4&callback=myMap"></script><!--get the map online-->

    </div>
</div>   

<?php include 'footer.php';?><!--include the footer-->

</body>
</html>