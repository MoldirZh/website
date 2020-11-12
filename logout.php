<html>
<head>
    <title>Logout</title>
</head>
<body>

<?php

session_start();
session_destroy();//destroy the session and delete all the data
header( "Location: home_page.php" );//redirect to home page
?>

</body>
</html>