<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id_client = $_SESSION['client_id'];

    $sql="SELECT * FROM client WHERE id_client = '$id_client'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req) ;

    if (isset($_POST['completed'])) {
        $request_id = $_POST['id_request'];
        $completed_time = date("Y-m-d H:i:s");
        $sql = "UPDATE suivi_job SET status = 'completed', time_completed='$completed_time' WHERE id_request = $request_id";
        mysqli_query($conn, $sql);

        header("Location: completed-jobs.php");
        exit();
    }

    $sql = "SELECT j.title, f.id_freelancer, f.first_name_free, f.last_name_free, f.profession, f.statut, f.exentation, s.message_job, s.status, s.time_accepted, s.id_request
            FROM suivi_job s
            JOIN jobs j ON s.id_job = j.id_job
            JOIN freelancer f ON s.id_freelancer = f.id_freelancer
            WHERE j.id_client = $id_client AND s.status = 'accepted'";

    $result = mysqli_query($conn, $sql);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>

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
            <a href="requests.php" class="logo">Requests Accepted</a>

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


    <!--=============== NavBar Requests section STARTS ===============-->
    <div class="navbar-request">
        <div class="nav-center">
            <ul>
                <li><a href="all-requests.php" <?php if (basename($_SERVER['PHP_SELF']) == 'all-requests.php') { echo 'class="active"'; } ?>><i class="fas fa-list"></i><span>All Requests</span></a></li>
                <li><a href="requests-accepted.php" <?php if (basename($_SERVER['PHP_SELF']) == 'requests-accepted.php') { echo 'class="active"'; } ?>><i class="fa-solid fa-check"></i><span>Requests Accepted</span></a></li>
                <li><a href="completed-jobs.php" <?php if (basename($_SERVER['PHP_SELF']) == 'completed-jobs.php') { echo 'class="active"'; } ?>><i class="fas fa-check-square"></i><span>Completed Jobs</span></a></li>
            </ul>
        </div>
    </div>
    <!--=============== NavBar Requests section ENDS ===============-->


    <!--=============== Requests section STARTS ===============-->
    <section>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="request">
            <div class="log">
                <?php   
                    if($row['statut']==0)  {
                        echo '<img class="image" src="../freelancer/photofreelancer/default.jpg">' ;
                    } else{
                        $ex = $row['exentation'];
                        $namf = $row['id_freelancer'] . '.' . $ex;
                        echo ' <img class="image" src="../freelancer/photofreelancer/'.$namf.'">';
                    }
                ?>
            </div>

            <div class="request_details">
                <div class="top_detail">
                    <div class="user_detail">
                        <h3><?php echo $row['first_name_free'] . ' ' . $row['last_name_free']; ?></h3>
                        <span>(<?php echo $row['profession']; ?>)</span>
                    </div>

                    <div class="more_detail">
                        <span>Accepted on <?php echo date('d/m/Y \a\\t H:i:s', strtotime($row['time_accepted'])); ?></span>
                    </div>
                </div>

                <span class="jobtitle">Job Title : <?php echo $row['title']; ?></span>
                
                <div class="request_para">
                    <p><?php echo $row['message_job']; ?></p>
                </div>

                <div class="request_action">
                    <a href="freelancer-profile.php?idfree=<?php echo $row['id_freelancer']; ?>"><button class="btt"><i class="fa-solid fa-user"></i></button></a>
                    <form method="POST">
                    <input type="hidden" name="id_request" value="<?php echo $row['id_request']; ?>">
                        <button class="btt" type="submit" name="completed"><i class="fa-solid fa-circle-check"></i></button>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    </section>
    <!--=============== Requests Profile section ENDS ===============-->


    <!--=============== Footer section STARTS ===============-->
    <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer>
    <!--=============== Footer section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>
</html>