<?php

@include 'config.php';
session_start();

if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = ($_POST['password']);


   //checking existence of a user for singup

   // reading from the database
   $select1 = " SELECT * FROM admin1 WHERE email = '$email' && password = '$pass' ";
   // connecting to the databse by $conn
   $result1 = mysqli_query($conn, $select1);

   // https://www.tutorialspoint.com/php/php_function_mysqli_fetch_array.htm 👇
   $row = mysqli_fetch_array($result1);


   // if user is already present 👇
   if (mysqli_num_rows($result1) > 0) {

      // echo "you are a user 👍";

      // used in the index.php to check user is logged in or not
      $_SESSION['user_name'] = $row['user_name'];

      // if user is already present then connecting home to the home or index page
      header('location:admin/admin_page.php');
   }

   // if user is not  present in th database 👇 then show him the error
   else {

      $error = "We can't find the user with the email , $email and password . Try another email and password";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>LoginPage</title>
   <link rel="stylesheet" href="css/login2.css">
</head>

<body>

   <div class="card">

      <div class="info">
         <img class="login-image" src="img/i2.jpg" alt="book image">
      </div>
      <div class="form-container">

         <form action="" method="post">
            <h3>login now</h3>
            <?php
            if (isset($error)) {
               foreach ($error as $error) {
                  echo '<span class="error-msg">' . $error . '</span>';
               };
            };
            ?>


            <input type="email" name="email" required placeholder="Enter your Email">
            <input type="password" name="password" required placeholder="Enter your Readers Cave password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="./admin/register.php">Register Now</a></p><br>
            <p> <a href="login2.php">User Login</a></p><br>
            <!---<p><a class="forget-p" href="forget.php"> Forgot your password </a></p>-->
         </form>

      </div>

   </div>

</body>

</html>