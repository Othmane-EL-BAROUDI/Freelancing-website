<?php
   @include 'config.php';

   if(isset($_POST['submit'])){

      $first_name_cli = mysqli_real_escape_string($conn, $_POST['first_name']);
      $last_name_cli = mysqli_real_escape_string($conn, $_POST['last_name']);
      $email_client = mysqli_real_escape_string($conn, $_POST['email']);
      $password_client = $_POST['password'];
      $cpassword_client = $_POST['cpassword'];

      $select = "SELECT * FROM client WHERE email_client = '$email_client' OR password_client = '$password_client'";
      $result = mysqli_query($conn, $select);

      if(mysqli_num_rows($result) > 0){
         $error[] = 'User already exists!';
      }else{
         if($password_client != $cpassword_client){
            $error[] = 'Password not matched!';
         }elseif(strlen($password_client) < 8){
            $error[] = 'Password must be at least 8 characters long!';
         }else{
            $insert = "INSERT INTO client(first_name_cli, last_name_cli, email_client, password_client) VALUES('$first_name_cli','$last_name_cli','$email_client','$password_client')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
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
   <title>register form</title>

   <!--=============== SHORTCUT ICON ===============-->
   <link rel="shortcut icon" href="../img/freelancelogo.png" type="image/x-icon">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
   <div class="form-container">

      <form action="" method="post">
         <h3>register now</h3>
         <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
         ?>
         <div class="form-group">
            <input type="text" name="first_name" style="display: inline-block; width: 48%;" required placeholder="First name" autocomplete="off">
            <input type="text" name="last_name" style="display: inline-block; width: 48%; margin-left: 10px;" required placeholder="Last name" autocomplete="off">
         </div>
         <input type="email" name="email" required placeholder="Enter your email" autocomplete="off">
         <input type="password" name="password" required placeholder="Enter your password" autocomplete="off">
         <input type="password" name="cpassword" required placeholder="Confirm your password" autocomplete="off">

         <input type="submit" name="submit" value="register now" class="form-btn">
         <p>already have an account? <a href="login_form.php">login now</a></p>
      </form>
      
   </div>

</body>
</html>