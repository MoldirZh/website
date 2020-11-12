<!DOCTYPE html>
<html>
<head>
	<title>Insert user</title>
	<meta charset="utf-8">
</head>
<body>
<h1> Adding a new user</h1> <!--adding header-->
<form method="post"> <!--define a form to collect user input with post method (for security reasons)-->
   <table><!--create a table to arrange texts and inputs-->
   	 <tr><td> Login <td><input name ='uname' pattern="[A-Za-z]{5,11}" title="Username should be in letters and more than 5 and less than 11" placeholder= "username" required><!--input name length is 5 to 11-->
   	 <tr><td> Email <td><input name ='email' placeholder= "email" pattern="[?=.*[@]]" title="Incorrect email format" required><!--inputting username-->
   	 <tr><td> Address <td><input name ='address' placeholder= "address" required><!--inputting username-->
   	 <tr><td> Telephone Number <td><input name ='telnumber' placeholder= "telnumber" pattern="^[ 0-9]+$" title="Incorrect telephone number format" required><!--inputting username-->
   	 <tr><td> Password<td><input type="password" name="password" pattern=".{4,}" title="Password must be more than 4 characters" placeholder="password" onchange="form.cpassword.pattern=this.value;" required><!--password with parameters-->
   	 <tr><td>Confirm Password<td><input type="password" name="cpassword" pattern=".{4,}" title="Password is not the same" placeholder="confirm password" required><!--confirming password-->
   	 <tr><td><input type='submit' name = "add" value="Add"></td><!--submit button-->
   </table>

   <?php
      if (isset($_POST['add'])) {
         $link = mysqli_connect("localhost", "root", "", "project"); //connect to database

         $uname = $_POST['uname'];//define a name variable
         $email = $_POST['email'];//define an email variable
         $address = $_POST['address'];//define an address variable
         $telnumber = $_POST['telnumber'];//define a telnumber variable
         $password = $_POST ['password'];//define a password variable

         $result = mysqli_query($link, "SELECT * FROM users WHERE username = '$uname'");//perform a query against the database to check if such user already exists

            if(mysqli_num_rows($result) == 0) {//if there are no users with such name
                 $query = mysqli_query($link, "INSERT INTO users (username, email, address, telnumber, password) VALUES ('$uname', '$email', '$address', '$telnumber', '$password')");//perform a query to db to insert a new user
               if ($query == true) //if query was performed successfully
                  {
                     echo "User has been added into database.";//show a message
                  }
            }
            else//if there is already a user with such name
            {
               echo '<script language="javascript">';
               echo 'alert("There is already a user with such name")';  //showing an alert box.
               echo '</script>';
            }

         mysqli_close ($link);//close the connection
      }
   ?>
</form>
</body>
</html>