<html>
<head>
    <title>Insert user</title>
</head>
<body>

<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "project"); //connect to database

$uname = $_POST['uname'];//define a name variable
$email = $_POST['email'];//define an email variable
$address = $_POST['address'];//define an address variable
$telnumber = $_POST['telnumber'];//define a telnumber variable
$password = $_POST ['password'];//define a password variable

  //define a variable depending on the usertype
if (!empty($_SESSION['uname'])) {
  $name = $_SESSION['uname'];
}

if (!empty($_SESSION['adminname'])) {
  $name = $_SESSION['adminname'];
}

  //update name and set a new session varible for the new username
  if (!empty($uname)) {
    $query = mysqli_query ($link, "UPDATE `users` SET `username` = '$uname' WHERE `username` = '$name'");
    
    if (!empty($_SESSION['uname'])) {
      $_SESSION['uname'] = $uname;
    }

    if (!empty($_SESSION['adminname'])) {
      $_SESSION['adminname'] = $uname;
    }

    header("location: account.php");
  }


//update email
if (!empty($email)) {
  $query = mysqli_query ($link, "UPDATE `users` SET `email` = '$email' WHERE `username` = '$name'");
}

//update address
if (!empty($address)) {
  $query = mysqli_query ($link, "UPDATE `users` SET `address` = '$address' WHERE `username` = '$name'");
}

//update telnumber
if (!empty($telnumber)) {
  $query = mysqli_query ($link, "UPDATE `users` SET `telnumber` = '$telnumber' WHERE `username` = '$name'");
}

//update password
if (!empty($password)) {
  $query = mysqli_query ($link, "UPDATE `users` SET `password` = '$password' WHERE `username` = '$name'");
}

if ($query == true) //if query was performed successfully
    {
        echo "User has been added into database.";//show a message
        $_SESSION['uname'] = $uname;
    }
else {
    echo "Wrong";
}

?>

</body>
</html>