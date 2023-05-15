<?php
   @include 'config.php';

   session_start();

   if(!isset($_SESSION['freelancer_name'])){
      header('location:login_form.php');
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>LANCER</title> 
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/freelancelogo.png" type="image/x-icon">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
   <body>
      <header class="header">
         <section class="flex">
         <a href="home.php" class="logo">Home</a>
            <div class="icons">
               <div id="menu-btn" class="fa fa-list"></div>
               <div id="user-btn" class="fas fa-user"></div>
            </div>
            <div class="profile">
               <h3 class="name"><span><i class="far fa-address-book"></i><?php echo $_SESSION['freelancer_name'] ?></span></h3>
               <p class="role">Freelancer</p>
               <hr>
               <div class="flex-btn">
                  
                  <a href="../login/logout.php" class="option-btn"><i class="fas fa-sign-out-alt"></i><br>logout</a>
                  <a href="profile.php" class="option-btn"><i class="fa-solid fa-user"></i><br>Profile</a>
               </div>
            </div>
         </section>
      </header>   

      <div class="side-bar">
         <div id="close-btn">
            <i class="fas fa-times"></i>
         </div>
            <nav class="navbar">
               <nav class="nav container">
                  <a href="home.html" class="nav__logo">
                     <img src="img/freelancelogo.png" alt="logo">
                  </a> 
               </nav>
               <a href="home.php"><i class="fas fa-home"></i><span>home</span></a>
               <a href="job-list.php"><i class="fas fa-th"></i><span>Job list</span></a>
               <a href="My_Requests.php"><i class="fas fa-question"></i><span>My Requests</span></a>
               <a href="mess.php"><i class="fas fa-inbox"></i><span>Messages</span></a>
               <a href="reviews.php"><i class="far fa-thumbs-up"></i><span>Reviews</span></a>
               <a href="help.php"><i class="fas fa-headset"></i><span>Help</span></a>
            </nav>
      </div>


      <section class="home-grid">
         <div class="box-container">
               <div class="imagee">
                  <img src="img/PngItem_1246919.png" alt="">
               </div>
         </div>
         <div class="box">
                  <h2 class="title">Hello back !</h2>
                  <p class="tutor">It is time to be productive ! using your time and resources wisely, you can unlock your full potential. </p>
               </div>
      </section>

      <section >
        <h2><i class="fas fa-quote-left	"></i> Some of the categories</h2>
        <hr><br>
        <div class="categoryy">
          <div class="itemm">
            <img src="img/originals/Untitled-1.jpg" alt="Item 1">
            <h3>Designer</h3>
            <p>A designer is a professional who uses creativity and technical skills to create visual or functional designs, such as graphics, logos, websites, or products.</p>
          </div>
          
          <div class="itemm">
            <img src="img/originals/Untitled-2.jpg" alt="Item 2">
            <h3>Translator</h3>
            <p>A translator is a professional who translates written or spoken words from one language to another, ensuring that the meaning and intent of the original message are accurately conveyed.</p>
          </div>
          
          <div class="itemm">
            <img src="img/originals/Untitled-3.jpg" alt="Item 3">
            <h3>Photographer</h3>
            <p>A photographer is a professional who uses a camera to capture images for various purposes, such as artistic expression, journalism, or commercial work.</p>
          </div>

          <div class="itemm">
            <img src="img/originals/Untitled-4.jpg" alt="Item 4">
            <h3>Content creator</h3>
            <p>A content creator is a person who produces various forms of content, such as videos, articles, and social media posts, for online audiences.</p>
          </div>
          
          <div class="itemm">
            <img src="img/originals/Untitled-5.jpg" alt="Item 5">
            <h3>Video editing</h3>
            <p>A video editor is a professional who edits and manipulates video footage to create a cohesive and engaging final product.</p>
          </div>
          
          <div class="itemm">
            <img src="img/originals/Untitled-6.jpg" alt="Item 6">
            <h3>Developer</h3>
            <p>A developer creates software applications using programming languages and tools.</p>
          </div>
        </div>
        <div class="box" style="   text-align: center;" >
            <a href="job-list.php" class="inline-btn">Check on more !</a>
         </div>
      </section>




      <footer class="footer">

         &copy; copyright @ 2023 <span>LANCER</span> | all rights reserved!

      </footer>

      <!--js   -->
      <script src="js/script2.js"></script>

   
   </body>
</html>


