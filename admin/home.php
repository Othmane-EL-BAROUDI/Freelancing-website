<?php
    session_start();

    @include '../login/config.php';

    $id_admin = $_SESSION['admin_id'];

    $sql="SELECT * FROM admin WHERE id_admin = '$id_admin'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req);

    // The number of freelancers who create an account
    $sql_freelancers = "SELECT count(*) from freelancer";
    $result_freelancers = mysqli_query($conn, $sql_freelancers);
    if (!$result_freelancers) {
        die("Error: " . mysqli_error($conn));
    }
    $row_freelancers = mysqli_fetch_array($result_freelancers);
    $freelancers_count = implode(',', $row_freelancers);

    // The number of clients who create an account
    $sql_clients = "SELECT count(*) from client";
    $result_clients = mysqli_query($conn, $sql_clients);
    if (!$result_clients) {
        die("Error: " . mysqli_error($conn));
    }
    $row_clients = mysqli_fetch_array($result_clients);
    $clients_count = implode(',', $row_clients);

    // The number of jobs available
    $sql_jobs = "SELECT count(*) from jobs";
    $result_jobs = mysqli_query($conn, $sql_jobs);
    if (!$result_jobs) {
        die("Error: " . mysqli_error($conn));
    }
    $row_jobs = mysqli_fetch_array($result_jobs);
    $jobs_count = implode(',', $row_jobs);
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>

    <!--=============== SHORTCUT ICON ===============-->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/style.css" />

    <!--=============== Font awesome cdn link ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>

    <div class="grid-container">
        <!--=============== Navbar section | START ===============-->
        <section>
            <nav>
                <a href="home.php" class="name_page">Home</a>

                <div class="profile">
                    <!-- <img src="img/profile-picture.jpg" alt=""> -->
                    <?php
                            if($num_ligne['statut']==0)  {
                                echo '<img class="profile-pic" src="photoadmin/default.jpg">' ;
                            } 
                            else{
                                $ex=$num_ligne['exentation'];
                                $namf=$id_admin.'.'.$ex;
                                echo ' <img class="profile-pic" src="photoadmin/'.$namf.'">';
                            }
                    ?>
                    <ul class="profile-link">
                        <li><a href="profile.php"><i class="fa-solid fa-user icon"></i> Profile</a></li>
                        <li><a href="../login/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    </ul>
                </div>
            </nav>
        </section>
        <!--=============== Navbar section | END ===============-->


        <!--=============== Side bar section | START ===============-->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <img src="img/logo.png" class="logo-title">
                    <span class="material-icons-outlined">Admin</span>
                </div>
            </div>

            <ul class="sidebar-list">
                <li>
                    <a href="home.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="material-icons-outlined">Home</span>
                    </a>
                </li>

                <li>
                    <a href="freelancers.php">
                        <i class="fas fa-users"></i>
                        <span class="material-icons-outlined">Freelancers</span>
                    </a>
                </li>
                
                <li>
                    <a href="clients.php">
                        <i class="fas fa-light fa-users-rectangle"></i>
                        <span class="material-icons-outlined">Clients</span>
                    </a>
                </li>
                
                <li>
                    <a href="admins.php">
                        <i class="fa-solid fa-users-gear"></i>
                        <span class="material-icons-outlined">Admins</span>
                    </a>
                </li>

                <li>
                    <a href="jobs.php">
                        <i class="fa-solid fa-table-list"></i>
                        <span class="material-icons-outlined">Jobs</span>
                    </a>
                </li>

                <li>
                    <a href="requests.php">
                        <i class="fa-solid fa-list"></i>
                        <span class="material-icons-outlined">Requests</span>
                    </a>
                </li>

                <li>
                    <a href="reviews.php">
                        <i class="fa-solid fa-star"></i>
                        <span class="material-icons-outlined">Reviews</span>
                    </a>
                </li>

                <li>
                    <a href="contact-us.php">
                        <i class="fas fa-envelope"></i>
                        <span class="material-icons-outlined">Contact</span>
                    </a>
                </li>
            </ul>
        </aside>
        <!--=============== Side bar section | END ===============-->


        <!--=============== Home section | START ===============-->
        <section>
            <ul class="box-info">
				<li>
                    <i class="bx fa-sharp fa-solid fa-user-tie"></i>
					<span class="text">
						<h3><?php echo intval($freelancers_count); ?></h3>
						<p>Freelancers</p>
					</span>
				</li>
				<li>
                    <i class="bx fa-sharp fa-solid fa-user"></i>
					<span class="text">
						<h3><?php echo intval($clients_count); ?></h3>
						<p>Clients</p>
					</span>
				</li>
				<li>
					<i class='bx fa-solid fa-list' ></i>
					<span class="text">
						<h3><?php echo intval($jobs_count); ?></h3>
						<p>Jobs posted</p>
					</span>
				</li>
			</ul>
        </section>
        <!--=============== Home section | END ===============-->
    </div>


    <!--=============== Footer section | START ===============-->
    <!-- <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer> -->
    <!--=============== Footer section | END ===============-->


    <script>
        const profile = document.querySelector('nav .profile');
        const imgProfile = profile.querySelector('img');
        const dropdownProfile = profile.querySelector('.profile-link');

        imgProfile.addEventListener('click', function () {
            dropdownProfile.classList.toggle('show');
        });

        window.addEventListener('click', function (e) {
            if(e.target !== imgProfile) {
                if(e.target !== dropdownProfile) {
                    if(dropdownProfile.classList.contains('show')) {
                        dropdownProfile.classList.remove('show');
                    }
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>

</body>
</html>
