<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id_client = $_SESSION['client_id'];

    $sql="SELECT * FROM client WHERE id_client = '$id_client'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req);

    // Check if search query parameter is set
    if(isset($_GET['search_box'])) {
        $search_query = mysqli_real_escape_string($conn, $_GET['search_box']);
        $sql = "SELECT * FROM freelancer WHERE CONCAT(first_name_free, ' ', last_name_free) LIKE '%$search_query%'";
    } else {
        $sql = "SELECT * FROM freelancer";
    }

    $result3 = mysqli_query($conn, $sql);

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


    <!--=============== Freelancers section STARTS ===============-->
    <section>
        <div style="text-align:center;">
            <form action="" method="get" class="search-form">
                <input type="text" name="search_box" required placeholder="search freelancers..." maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form>
        </div>

        <div class="main-free" style="margin-top: 20px;">
            <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
            <div class="profile-card-free">
                <div class="image-free">
                    <?php   
                        if($row['statut']==0)  {
                        echo '<img class="profile-pic-free" src="../freelancer/photofreelancer/default.jpg">' ;
                        } 
                        else{
                            $id=$row['id_freelancer'];

                            $ex=$row['exentation'];
                            $namf=$id.'.'.$ex;
                            echo ' <img class="profile-pic-free" src="../freelancer/photofreelancer/'.$namf.'">';
                        }
                    ?>
                </div>

                <div class="data-free">
                    <h2><?php echo $row['first_name_free'] . ' ' . $row['last_name_free']; ?></h2>
                    <span><?php echo $row['profession']; ?></span>
                </div>

                <div class="row-free">
                    <div class="info-free">
                        <h3>Hourly Rate</h3>
                        <span>$<?php echo $row['hourly_rate']; ?>/hour</span>
                    </div>

                    <div class="info-free">
                        <h3>Job Success</h3>
                        <span><?php echo get_completed_jobs_count($row['id_freelancer']); ?></span>
                    </div>
                </div>

                <div class="rating">
                    <?php
                        $freelancer_id = $row['id_freelancer'];
                        $avg_query = "SELECT AVG(rating) AS average_rating, COUNT(*) AS review_count FROM reviews WHERE id_freelancer = $freelancer_id";
                        $avg_result = mysqli_query($conn, $avg_query);
                        $avg_row = mysqli_fetch_assoc($avg_result);
                        $avg_rating = $avg_row['average_rating'];
                        $review_count = $avg_row['review_count'];
                        $stars = round($avg_rating * 2) / 2;
                        $full_stars = floor($stars);
                        $half_star = ceil($stars - $full_stars);
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $full_stars) {
                                echo '<i class="fas fa-star"></i>';
                            } elseif ($half_star == 1 && $i == $full_stars + 1) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            } else {
                                echo '<i class="far fa-star"></i>';
                            }
                        }
                    ?>
                </div>

                <h3>(<?php echo $review_count; ?> Reviews)</h3>

                <div class="buttons-free">
                    <a href="messages.php?freelancer_id=<?php echo $row['id_freelancer']; ?>" class="btttn">Message</a>
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