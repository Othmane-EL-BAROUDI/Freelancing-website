<?php
    session_start();

    @include '../login/config.php';

    $id_client = $_SESSION['client_id'];

    $sql="SELECT * FROM client WHERE id_client = '$id_client'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req) ;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $first_name = $_POST['first_name_contact'] ?? '';
        $last_name = $_POST['last_name_contact'] ?? '';
        $email = $_POST['email_contact'] ?? '';
        $subject = $_POST['subject_contact'] ?? '';
        $message = mysqli_real_escape_string($conn, $_POST['message_contact'] ?? '');
          
        $sql = "INSERT INTO contact_us (idsend, first_name_contact, last_name_contact, email_contact, subject_contact, message_contact) VALUES ('$id_client', '$first_name', '$last_name', '$email', '$subject', '$message')";
        if (mysqli_query($conn, $sql)) {
            // inserted successfully
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>

    <!--=============== SHORTCUT ICON ===============-->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

    <!--=============== Font awesome cdn link ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!--=============== Custom css file link ===============-->
    <link rel="stylesheet" href="CSS/style.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".default_option").click(function(){
            $(".filter ul").addClass("active");
            });

            $(".filter ul li").click(function(){
            var text = $(this).text();
            $(".default_option").text(text);
            $(".filter ul").removeClass("active");
            });
        });
    </script>

</head>
<body>

    <!--=============== Header section STARTS ===============-->
    <header class="header">
        <section class="flex">
            <a href="help.php" class="logo">Help</a>

            <div class="icons">
                <div id="menu-btn" class="fa-sharp fa-solid fa-bell"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

            <div class="profile">
                <?php
                    if($num_ligne['statut']==0)  {
                    echo '<img class="image" src="photoclient/default.jpg">' ;
                    } 
                    else{
                        $ex=$num_ligne['exentation'];
                        $namf=$id_client.'.'.$ex;
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


    <!--=============== FAQ section STARTS ===============-->
    <section>
        <div class="headline">
            <h3><i class="fa-regular fa-circle-question"></i> Frequently Asked Questions (FAQ)</h3>
        </div>

        <details>
            <summary>How do I post a job?</summary>
            <div class="faq_content">
                <p>To post a job, navigate to the "Post a Job" page. Here you can enter all the details of the job and set a budget...</p>
            </div>
        </details>

        <details>
            <summary>Can I edit my job after posting it?</summary>
            <div class="faq_content">
                <p>Yes, you can edit your job at any time before a freelancer accepts it. After a freelancer has accepted the job, you will need to contact them directly to discuss any changes.</p>
            </div>
        </details>

        <details>
            <summary>How do I choose a freelancer for my job?</summary>
            <div class="faq_content">
                <p>Once you have posted a job, freelancers will be able to view it and submit proposals. You can review these proposals and choose a freelancer based on their experience, skills...</p>
            </div>
        </details>
    </section>
    <!--=============== FAQ section ENDS ===============-->


    <!--=============== Contact Us section STARTS ===============-->
    <section>
        <div class="headline">
            <h3><i class="fa-solid fa-envelope"></i> Contact Us</h3>
        </div>
        
        <section class="contact section" id="contact">
            <div class="contact__section">
                <form class="contact__form" action="" method="post" autocomplete="off">
                    <input type="text" name="first_name_contact" class="contact-form-text" style="display: inline-block; width: 48%;" required placeholder="First name">
                    <input type="text" name="last_name_contact" class="contact-form-text" style="display: inline-block; width: 48%; margin-left: 20px;" required placeholder="Last name">
                    <input type="email" name="email_contact" class="contact-form-text" required placeholder="Your email">
                    <input type="text" name="subject_contact" class="contact-form-text" required placeholder="Message Subject...">
                    <textarea name="message_contact" class="contact-form-text" required placeholder="Drop your message here..."></textarea>
                    <input type="submit" class="contact-form-btn" value="Send">
                </form>
            </div>
        </section>
    </section>
    <!--=============== Contact Us section ENDS ===============-->


    <!--=============== Footer section STARTS ===============-->
    <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer>
    <!--=============== Footer section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>
</html>