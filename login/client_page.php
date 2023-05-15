<?php
   @include 'config.php';

   session_start();

   if(!isset($_SESSION['client_name'])){
      header('location:login_form.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>client page</title>

   <!--=============== SHORTCUT ICON ===============-->
   <link rel="shortcut icon" href="../img/freelancelogo.png" type="image/x-icon">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>Hi, <span>Client</span></h3>
      <h1>welcome <span><?php echo $_SESSION['client_name'] ?></span></h1>
      <p>This is a Client page</p>
      <a href="../client/home.php" class="btn">continue</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>