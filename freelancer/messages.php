<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id = $_SESSION['freelancer_id'];

    $sql="SELECT * FROM freelancer WHERE id_freelancer = '$id'";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req) ;

    $client_id = $_GET['client_id'];

    if ($client_id) {
        // Get the name of the freelancer
        $sql3 = "SELECT * FROM client WHERE id_client = '$client_id'";
        $result_name = mysqli_query($conn, $sql3);
        $row_name = mysqli_fetch_assoc($result_name);
        $freelancer_name = $row_name['first_name_cli'] . ' ' . $row_name['last_name_cli'];
        
        // Get the messages between the client and freelancer
        $id_client = $client_id;

        $sql = "SELECT * FROM messages WHERE id_client = '$client_id' AND id_freelancer = '$id' order by id_message ";
        $result = mysqli_query($conn, $sql);

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

      <link rel="stylesheet" href="css/mess.css">


   </head>
   <body>
   <header class="header">
         <section class="flex">
         <a href="" class="logo">Chating with : <p class="tutor"><?php echo $row_name['first_name_cli'] . ' ' . $row_name['last_name_cli'] ?></p></a>
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


      <div class="container-mess" style="background: aquamarine;">
            <!-- CHAT-BOX -->
            <div class="chatbox">
               <div class="rightSide">
                           <?php if ($result != null) {
                                 while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="message <?php echo $row['id_sender'] == $_SESSION['freelancer_id'] ? 'my_msg' : 'friend_msg'; ?>">
                                       <p>
                                             <?php echo $row['message_fc']; ?>
                                             <br><span><?php echo date('H:i', strtotime($row['time_sent_message'])); ?></span>
                                       </p>
                                    </div>
                                 <?php }
                           } ?>
               </div>                
                        
                        <!-- CHAT INPUT -->
                        <form method="post" action="insert_messages_free.php?client_id=<?php echo $id_client; ?>">
                           <div class="chat_input">
                                 <input type="text" name="message_fc" placeholder="Type a message" required autocomplete="off">
                                 <button type="submit" name="send_message"><i class="fas fa-duotone fa-paper-plane"></i></button>
                           </div>
                        </form>

            </div>

      </div>

      <!--js   -->
      <script src="js/script2.js"></script>

   </body>


</html>