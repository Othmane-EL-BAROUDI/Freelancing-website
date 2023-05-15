<?php
  @include 'config.php';
    session_start();
    
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
            <a href="profile.php" class="logo">Request</a>
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
                        <img src="img/originals/Lightbulb-60b6.png" alt="">
                    </div>
            </div>
            <div class="box">
                        <h2 class="title">Request</h2>
                        <p class="tutor">Here you can send a request to work with this client </p>
                        <hr>
            </div>
        </section>

        <section class="contact">
            <div class="row">

                <form method="POST" action="">
                    <h3>Request to the client</h3>
                    <textarea name="message_job" class="box" placeholder="enter your message" required maxlength="1000" cols="30" rows="10" id="message_job"></textarea>
                    <input type="submit" value="Send" class="inline-btn" name="submit">
                </form>

            </div>
        </section>



        <footer class="footer">

        &copy; copyright @ 2023 <span>LANCER</span> | all rights reserved!

        </footer>

        <!--js   -->
        <script src="js/script2.js"></script>


    </body>
</html>