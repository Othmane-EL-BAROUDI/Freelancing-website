<?php
    session_start();

   $pdo = new PDO('mysql:host=localhost;dbname=lancer','root','');
   $sqlstate = $pdo ->prepare('select * FROM jobs INNER JOIN client on client.id_client=jobs.id_client where jobs.job_status = "public"');
   $sqlstate ->execute();
   $jobs = $sqlstate ->fetchALL(PDO::FETCH_ASSOC);

   @include '../login/config.php';

    
   if(!isset($_SESSION['freelancer_name'])){
      header('location:login_form.php');
          }
  
          $sell = "SELECT * FROM freelancer ";
          $qyerry= mysqli_query($conn, $sell);
        $resul = mysqli_fetch_assoc($qyerry);
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
                     <a href="job-list.php" class="logo">Job list</a>
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
                  <img src="img/originals/Internet-60b6.png" alt="">
               </div>
         </div>
         <div class="box">
                  <h2 class="title">JOBS</h2>
                  <p class="tutor">Choose between the jobs, and find the one you like ! </p>
                  <hr>
               </div>
      </section>

      <section class="Requests">
            <?php foreach($jobs as $jobs){
               ?>
               <div class="box-container">
                  <div class="box">
                     <div class="tutor">
                        <?php   
                              if($jobs['statut']==0)  {
                                    echo '<img src="photoclient/default.jpg">' ;
                              } 
                              else{
                                 $id = $jobs['id_client'];
                                    $ex=$jobs['exentation'];
                                    $namf=$id.'.'.$ex;
                                    echo ' <img src="photoclient/'.$namf.'">';
                              }
                           ?>
                           <div class="info">
                              <h3><?php echo $jobs['first_name_cli'] . ' ' . $jobs['last_name_cli']; ?></h3>
                              <button> Job type : <?php echo $jobs['type'] ?> </button>
                           </div>
                     </div>
                        <h3 class="title" style="margin-left: 20px;"><?php echo $jobs['title'] ?></h3>
                        <button style="backround-color : red;margin-left: 20px; font-size : 15px;"> Category : <?php echo $jobs['category'] ?></button><br>
                           <span style="color : red; margin-left: 20px; font-size : 15px;"> Delivery time : <?php echo $jobs['time'] ?> days</span>
                        <br>
                        <br>
                           <div class="card" style="background-color : #f0f0f0 ; transition: all .3s ease; box-shadow: 0px 3px 15px 3px rgba(0,0,0,0.15);">
                              <p class="descriptionn" ><?php echo $jobs['description'] ?></p>
                           </div>
                           <br>
                        <a href="messages.php?client_id=<?php echo $jobs['id_client']; ?>" class="inline-btn">Send a message</a>
                        <a href="request.php" class="inline-btn">Send a request</a> 
                  </div>
               </div>
               <br>
               <?php
            }?>
      </section>




      <footer class="footer">

         &copy; copyright @ 2023 <span>LANCER</span> | all rights reserved!

      </footer>

      <!--js   -->
      <script src="js/script2.js"></script>

         
   </body>
</html>


