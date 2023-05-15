<?php
  @include 'config.php';
    session_start();
    
    if(!isset($_SESSION['freelancer_name'])){
    header('location:login_form.php');
        }

        $sell = "SELECT * FROM freelancer ";
        $qyerry= mysqli_query($conn, $sell);
      $resul = mysqli_fetch_assoc($qyerry);


      if (isset($_POST['submit'])) {
        
        $first_name_contact = mysqli_real_escape_string($conn, $_POST['first_name_contact']);
        $last_name_contact = mysqli_real_escape_string($conn, $_POST['last_name_contact']);
        $email_contact = mysqli_real_escape_string($conn, $_POST['email_contact']);
        $subject_contact = mysqli_real_escape_string($conn, $_POST['subject_contact']);
        $message_contact = mysqli_real_escape_string($conn, $_POST['message_contact']);  

        
        $freelancer_id = $_SESSION['freelancer_id'];

        $insert = "INSERT INTO contact_us(first_name_contact, last_name_contact, email_contact, subject_contact, message_contact) VALUES('$first_name_contact','$last_name_contact','$email_contact','$subject_contact','$message_contact')";
        mysqli_query($conn, $insert);}

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
                <a href="help.php" class="logo">Help</a>
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
                        <img src="img/originals/Design tools-60b6.png" alt="">
                    </div>
            </div>
            <div class="box">
                        <h2 class="title">HELP</h2>
                        <p class="tutor">Here you can contact us, and there is a FAQ at the bottom if you need it </p>
                        <hr>
            </div>
        </section>

        <section class="contact">

            <div class="row">
                <form method="POST" action="">
                    <h3>Contact us !!</h3>
                        <input type="text" name="first_name_contact" required maxlength="50" class="box" required placeholder="First name" >
                        <input type="text" name="last_name_contact" required maxlength="50" class="box" required placeholder="Last name">
                    <input type="email" placeholder="enter your email" name="email_contact" required maxlength="50" class="box" id="email_contact">
                    <input type="text" placeholder="enter your subject" name="subject_contact" required maxlength="50" class="box" id="subject_contact">
                    <textarea name="message_contact" class="box" placeholder="enter your message" required maxlength="1000" cols="30" rows="10" id="message_contact"></textarea>
                    <input type="submit" value="send message" class="inline-btn" name="submit">
                </form>
            </div>

            <div class="box-container">

                <div class="box">
                    <i class="fas fa-phone"></i>
                    <h3>phone number</h3>
                    <a href="tel:1234567890">123-456-7890</a>
                    <a href="tel:1112223333">111-222-3333</a>
                </div>
                
                <div class="box">
                    <i class="fas fa-envelope"></i>
                    <h3>email address</h3>
                    <a href="mailto:elbakri4hamza@gmail.com">elbakri4hamza@gmail.come</a>
                    <a href="mailto:@gmail.com">@gmail.come</a>
                </div>

                <div class="box">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>office address</h3>
                    <a href="#">===</a>
                </div>

            </div>

        </section>
        <br>
        <div class="faq-container">
            <h3>Frequently Asked Questions</h3>
            <br>
            <div class="faq">
                <div class="question">
                        <h3 style="margin-left: 40px;">What is the process for hiring a freelancer?</h3>
                        <p></p>
                    </div>
                <div class="answer">
                        <p>Once a client has received bids for their job listing, they can review each bid and select the freelancer they want to hire. The client and freelancer can then communicate to discuss the details of the job and come to an agreement on the scope and timeline.</p>
                    </div>
            </div>
            <div class="faq">
                <div class="question">
                        <h3 style="margin-left: 40px;">How does this website work?</h3>
                        <p></p>
                    </div>
                <div class="answer">
                        <p>A: Clients can create a job listing on the website by providing details about the job they need completed. Freelancers can then browse the listings and submit a bid for the job. The client can review the bids and select the freelancer they want to hire.</p>
                    </div>
            </div>
            <div class="faq">
                <div class="question">
                        <h3 style="margin-left: 40px;">What if there is a dispute between the client and freelancer?</h3>
                        <p></p>
                    </div>
                <div class="answer">
                        <p>The website may offer dispute resolution services to help resolve any issues between the client and freelancer. Both parties should try to work out any issues between themselves first, but the website can provide assistance if needed.</p>
                    </div>
                    </div>
        </div>

        <footer class="footer">

            &copy; copyright @ 2023 <span>LANCER</span> | all rights reserved!

        </footer>
        <!--js   -->
        <script src="js/script2.js"></script>
    </body>
</html>