<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if search query parameter is set
    if(isset($_GET['search_box'])) {
        $search_query = mysqli_real_escape_string($conn, $_GET['search_box']);
        $sql = "SELECT * FROM client WHERE CONCAT(first_name_cli, ' ', last_name_cli) LIKE '%$search_query%'";
    } else {
        $sql = "SELECT * FROM client";
    }

    $result = mysqli_query($conn, $sql);


    function get_completed_jobs_count($freelancer_id) {
        $conn = mysqli_connect('localhost', 'root', '', 'lancer');
    
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Count the number of completed jobs for the freelancer
        $sql = "SELECT COUNT(*) AS count FROM suivi_job WHERE id_freelancer = '$freelancer_id' AND status = 'completed'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
    
        mysqli_close($conn);
    
        return $count;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancers</title>

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
            <a href="freelancers.php" class="logo">Freelancers</a>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

            <div class="profile">
                <img src="img/pic-1.jpg" class="image" alt="">
                <h3 class="name"><?php echo $_SESSION['client_name'] ?? $_SESSION['freelancer_name']; ?></h3>
                <p class="role">Client</p>
                <br>
                <a href="profile.php" class="btn">view profile</a>
            </div>
        </section>
    </header>
    <!--=============== Header section ENDS ===============-->   


    <!--=============== Side bar section STARTS ===============-->
    <div class="side-bar">

        <div id="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">
            <img src="img/logo.png" class="image" alt="">
        </div>

        <br><br><br>

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
                
                <li>
                    <a href="../login/logout.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log out</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!--=============== Side bar section ENDS ===============-->


    <!--=============== Freelancers section STARTS ===============-->
    <section>
        <h1 class="heading">All Freelancers</h1>
        <div style="text-align:center;">
            <form action="" method="get" class="search-form">
                <input type="text" name="search_box" required placeholder="search freelancers..." maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form>
        </div>

        <div class="main-free">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="profile-card-free">
                <div class="image-free">
                    <img src="img/pic-1.jpg" alt="" class="profile-pic-free">
                </div>

                <div class="data-free">
                    <h2><?php echo $row['first_name_cli'] . ' ' . $row['last_name_cli']; ?></h2>
                    <span>teeeest</span>
                </div>

                <div class="row-free">
                    <div class="info-free">
                        <h3>Hourly Rate</h3>
                        <span>$10/hour</span>
                    </div>

                    <div class="info-free">
                        <h3>Job Success</h3>
                        <span>20</span>
                    </div>
                </div>

                <div class="rating">
                    ********
                </div>

                <h3>(2 Reviews)</h3>

                <div class="buttons-free">
                    <a href="messages.php?client_id=<?php echo $row['id_client']; ?>" class="btttn">Message</a>
                    <a href="freelancer-profile.php?idfree=<?php echo $row['id_freelancer']; ?>" class="btttn">View Profile</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!--=============== Freelancers section ENDS ===============-->


    <!--=============== Footer section STARTS ===============-->
    <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer>
    <!--=============== Footer section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>
</html>