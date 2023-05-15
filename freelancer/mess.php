<?php

$pdo = new PDO('mysql:host=localhost;dbname=lancer','root','');
$sqlstate = $pdo ->prepare('select * FROM client INNER JOIN messages on client.id_client=messages.id_client Where client.id_client=messages.id_client');
$sqlstate ->execute();
$cli = $sqlstate ->fetchALL(PDO::FETCH_ASSOC);

@include '../login/config.php';
$displayed_clients = array();


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
         <a href="mess.php" class="logo">Messages</a>
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
                  <img src="img/originals/Group chat-60b6.png" alt="">
               </div>
         </div>
         <div class="box">
                  <h2 class="title">Messages</h2>
                  <p class="tutor">Here are all the clients you've contacted. </p>
                  <hr>
               </div>
      </section>

      <section class="Requests">
            <?php foreach($cli as $cli){
            if (!in_array($cli['id_client'], $displayed_clients)) {
               ?>
               <div class="box-container">

                  <div class="box">
                     <div class="tutor">
                        <!-- <img src="img/5894085.png" alt=""> -->

                        <?php   
                              if($cli['statut']==0)  {
                                    echo '<img src="photoclient/default.jpg">' ;
                              } 
                              else{
                                 $id = $cli['id_client'];
                                    $ex=$cli['exentation'];
                                    $namf=$id.'.'.$ex;
                                    echo ' <img src="photoclient/'.$namf.'">';
                              }
                           ?>
                           <div class="info">

                              <h3><?php echo $cli['first_name_cli'] . ' ' . $cli['last_name_cli']; ?></h3>
                              <button> Client Email : <?php echo $cli['email_client'] ?> </button>
                           </div>
                     </div>
                        <button style="backround-color : red;margin-left: 200px; font-size : 15px; "> DATE : <?php echo $cli['time_sent_message'] ?></button><br>
                        <a href="messages.php?client_id=<?php echo $cli['id_client']; ?>" class="inline-btn" style=" display: flex;">Messages</a>
                        
                     <!-- Trigger/Open The Modal -->

                        
                  </div>
               </div>
               <br>
               <?php
               $displayed_clients[] = $cli['id_client'];
            }}?>
      </section>


      <footer class="footer">

         &copy; copyright @ 2023 <span>LANCER</span> | all rights reserved!

      </footer>

      <!--js   -->
      <script src="js/script2.js"></script>

      
   </body>
</html>