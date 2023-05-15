<?php
   session_start();

   $conn = mysqli_connect("localhost", "root", "", "lancer");

   $id=$_SESSION['client_id'];
   $sql="SELECT * FROM client WHERE id_client = '$id'  ";
   $req = mysqli_query($conn , $sql) ;
   $num_ligne = mysqli_fetch_assoc($req) ;
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!--=============== SHORTCUT ICON ===============-->
   <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

   <!--=============== Font awesome cdn link ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!--=============== Custom css file link ===============-->
   <link rel="stylesheet" href="CSS/style.css">

</head>
<body>

   <!--=============== Header section STARTS ===============-->
   <header class="header">
      <section class="flex">
         <a href="home.php" class="logo">Home</a>

         <div class="icons">
            <div id="menu-btn" class="fa-sharp fa-solid fa-bell"></div>
            <div id="user-btn" class="fas fa-user" onclick="toggleMenu()"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
         </div>

         <div class="profile" id="dropdown-profile">
            <?php   
               if($num_ligne['statut']==0)  {
               echo '<img class="image" src="photoclient/default.jpg">' ;
               } 
               else{
                  $ex=$num_ligne['exentation'];
                  $namf=$id.'.'.$ex;
                  echo ' <img class="image" src="photoclient/'.$namf.'">';
               }
            ?>
            <h3 class="name"><?php echo substr($_SESSION['client_name'] ?? $_SESSION['freelancer_name'], 0, 18); ?></h3>
            <p class="role">Client</p>
            <hr>
            <a href="profile.php" class="sub-menu-link">
               <i class="fa-solid fa-user"></i>
               <p>View Profile</p>
               <span>></span>
            </a>

            <a href="../login/logout.php" class="sub-menu-link">
               <i class="fas fa-sign-out-alt"></i>
               <p style="margin-right: 30px;">Log out</p>
               <span>></span>
            </a>
         </div>
      </section>
   </header>
   <!--=============== Header section ENDS ===============-->   


   <!--=============== Side bar section STARTS ===============-->
   <div class="side-bar">

      <div class="profile">
         <img src="img/logo.png" class="image" alt="">
      </div>

      <nav class="navbar">
         <ul>
            <li>
               <a href="home.php">
                  <i class="fas fa-home"></i>
                  <span>Home</span>
               </a>
            </li>

            <li>
               <a href="post-a-job.php">
                  <i class="fa-sharp fas fa-upload"></i>
                  <span>Post a Job</span>
               </a>
            </li>

            <li>
               <a href="my-jobs.php">
                  <i class="fas fa-clipboard-list"></i>
                  <span>My Jobs</span>
               </a>
            </li>

            <li>
               <a href="freelancers.php">
                  <i class="fas fa-users"></i>
                  <span>Freelancers</span>
               </a>
            </li>

            <!-- <li>
               <a href="messages.php">
                  <i class="fas fa-comments"></i>
                  <span>Messages</span>
               </a>
            </li> -->

            <li>
               <a href="all-requests.php">
                  <i class="fa-sharp fa-solid fa-file-circle-check"></i>
                  <span>Job Requests</span>
               </a>
            </li>

            <li>
               <a href="help.php">
                  <i class="fas fa-question-circle"></i>
                  <span>Help</span>
               </a>
            </li>
            
            <!-- <li>
               <a href="../login/logout.php" class="logout">
                  <i class="fas fa-sign-out-alt"></i>
                  <span>Log out</span>
               </a>
            </li> -->
         </ul>
      </nav>
   </div>
   <!--=============== Side bar section ENDS ===============-->


   <!--=============== Welcome section STARTS ===============-->
   <section>
      <div class="welcome-areaa">
         <div class="containerr">
            <div class="left-wel">
               <div class="big-titlee">
                  <h1>Hire experts freelancers</h1>
                  <h1>for any job,</h1>
                  <h1>any time.</h1>
               </div>
               <p class="textt">
                  Huge community of designers, developers and creatives ready for your project.
               </p>
               <div class="cta">
                  <a href="post-a-job.php" class="bttn">Post a Job</a>
                  <!-- <a href="#" class="inline-btn">Post a Job</a> -->
               </div>
            </div>

            <div class="right-wel">
               <img src="img/person.png" alt="Person Image" class="personn" />
            </div>
         </div>
      </div>
   </section>
   <!--=============== Welcome section ENDS ===============-->


   <!-- =============== Footer section STARTS ===============-->
   <footer class="footer">
      <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
   </footer>
   <!--=============== Footer section ENDS =============== -->


   <!--=============== Custom js file link ===============-->
   <script src="JS/script.js"></script>

</body>
</html>