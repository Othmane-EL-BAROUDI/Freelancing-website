<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id = $_SESSION['client_id'];

    $sql="SELECT * FROM client WHERE id_client = '$id'";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req) ;

    // Get the ID of the freelancer that the client is chatting with
    $freelancer_id = $_GET['freelancer_id'];

    if ($freelancer_id) {
        // Get the name of the freelancer
        $sql3 = "SELECT * FROM freelancer WHERE id_freelancer = '$freelancer_id'";
        $result_name = mysqli_query($conn, $sql3);
        $row_name = mysqli_fetch_assoc($result_name);
        $freelancer_name = $row_name['first_name_free'] . ' ' . $row_name['last_name_free'];
        
        // Get the messages between the client and freelancer
        $id_freelancer = $freelancer_id;

        $sql = "SELECT * FROM messages WHERE id_freelancer = '$freelancer_id' AND id_client = '$id' order by id_message ";
        $result = mysqli_query($conn, $sql);
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

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
            <a href="messages.php" class="logo">Messages</a>
            
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


    <!--=============== Messages section STARTS ===============-->
    <section>
        <div class="container-mess" style="border: 2px solid white;">
            <div class="rightSide">
                <div class="headerr">
                    <div class="imgText">
                        <div class="userimg">
                            <?php   
                                if($row_name['statut']==0)  {
                                echo '<img class="cover" src="../freelancer/photofreelancer/default.jpg">' ;
                                } 
                                else{
                                    $ex=$row_name['exentation'];
                                    $namf=$freelancer_id.'.'.$ex;
                                    echo ' <img class="cover" src="../freelancer/photofreelancer/'.$namf.'">';
                                }
                            ?>
                        </div>
                        <h4><?php echo $freelancer_name; ?><br><span>online</span></h4>
                    </div>
                    <div class="logo-profile">
                        <a href="freelancer-profile.php?idfree=<?php echo $freelancer_id; ?>">
                            <button class="bbbtt" type="submit">
                                <i class="fa-solid fa-user"></i>
                            </button>
                            
                        </a>
                    </div>
                </div>
    
                <!-- CHAT-BOX -->
                <div class="chatbox">
                    <?php if ($result != null) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="message <?php echo $row['id_sender'] == $_SESSION['client_id'] ? 'my_msg' : 'friend_msg'; ?>">
                                <p>
                                    <?php echo $row['message_fc']; ?>
                                    <br><span><?php echo ltrim(date('H:i', strtotime($row['time_sent_message'])), '0'); ?></span>
                                </p>
                            </div>
                        <?php }
                    } ?>
                </div>                
                
                <!-- CHAT INPUT -->
                <form method="post" action="insert_messages_cli.php?freelancer_id=<?php echo $id_freelancer; ?>">
                    <div class="chat_input">
                        <input type="text" name="message_fc" placeholder="Type a message" required autocomplete="off">
                        <button type="submit" name="send_message"><i class="fas fa-duotone fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--=============== Messages section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>

</html>