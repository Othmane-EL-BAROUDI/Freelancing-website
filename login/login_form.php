<?php
   @include 'config.php';

   session_start();

   if(isset($_POST['submit'])){

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = $_POST['password'];

      // Check if the user is a freelancer
      $select1 = "SELECT * FROM freelancer WHERE email_freelancer = '$email' AND password_freelancer = '$pass'";
      $result1 = mysqli_query($conn, $select1);

      if(mysqli_num_rows($result1) > 0){

         $row = mysqli_fetch_array($result1);

         $_SESSION['freelancer_name'] = $row['first_name_free'] . ' ' . $row['last_name_free'];
         $_SESSION['freelancer_id'] = $row['id_freelancer'];
         header('location:freelancer_page.php');

      }else{
         // Check if the user is a client
         $select2 = "SELECT * FROM client WHERE email_client = '$email' AND password_client = '$pass'";
         $result2 = mysqli_query($conn, $select2);

         if(mysqli_num_rows($result2) > 0){

            $row = mysqli_fetch_array($result2);

            $_SESSION['client_name'] = $row['first_name_cli'] . ' ' . $row['last_name_cli'];
            $_SESSION['client_id'] = $row['id_client'];
            header('location:client_page.php');

         }else{
            // Check if the user is an admin
            $select3 = "SELECT * FROM admin WHERE email_admin = '$email' AND password_admin = '$pass'";
            $result3 = mysqli_query($conn, $select3);

            if(mysqli_num_rows($result3) > 0){

               $row = mysqli_fetch_array($result3);

               $_SESSION['admin_name'] = $row['first_name_admin'] . ' ' . $row['last_name_admin'];
               $_SESSION['admin_id'] = $row['id_admin'];
               header('location:admin_page.php');

            } else {
               $error[] = 'Incorrect email or password!';
            }
         }
      }
   };
?>





<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!--=============== SHORTCUT ICON ===============-->
   <link rel="shortcut icon" href="../img/freelancelogo.png" type="image/x-icon">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <div class="form-container">

      <form action="" method="post">
         <h3>login now</h3>
         <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
         ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">

         <input type="submit" name="submit" value="login now" class="form-btn">
         <p>don't have an account? <a href="join_as.php">register now</a></p>
      </form>

   </div>

</body>
</html>