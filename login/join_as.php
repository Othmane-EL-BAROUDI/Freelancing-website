<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Join As</title>

   <!--=============== SHORTCUT ICON ===============-->
   <link rel="shortcut icon" href="../img/freelancelogo.png" type="image/x-icon">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <div class="form-container">

      <form action="" method="post">
         <h3>Join As</h3>

         <select name="user_type" onchange="location = this.value;">
            <option value="">Select user type...</option>
            <option value="register_form_freelancer.php">Freelancer</option>
            <option value="register_form_client.php">Client</option>
         </select>
      </form>
   </div>

</body>
</html>