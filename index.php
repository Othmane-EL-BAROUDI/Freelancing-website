<?php
    $conn = mysqli_connect('localhost','root','','lancer');
    
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== SHORTCUT ICON ===============-->
    <link rel="shortcut icon" href="img/freelancelogo.png" type="image/x-icon">

    <!--=============== REMIX ICON ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== SOCIAL LINKS ===============-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="CSS/style.css">

    <title>LANCER</title>
</head>
<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav__logo">
                <img src="img/freelancelogo.png" alt="logo"> LANCER
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="#join" class="nav__link">Join Us</a>
                    </li>

                    <li class="nav__item">
                        <a href="#statistics" class="nav__link">Statistics</a>
                    </li>
                    
                    <div class="nav__link">
                        <a href="login/login_form.php" class="button nav__button" style="padding: 8px 12px; font-size: 15px;">Log In</a>
                    </div>

                    <div class="nav__link">
                        <a href="login/join_as.php" class="button nav__button" style="padding: 8px 12px; font-size: 15px;">Register Now</a>
                    </div>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>

            <!--==== Toggle Button ====-->
            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-menu-line"></i>
            </div>

        </nav>
    </header>


    <!--=============== MAIN ===============-->
    <main class="main">
        <!--==== Home ====-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__data">
                    <h2 class="home__subtitle">HIRE/BE THE BEST </h2>
                    <h1 class="home__title">FREELANCERS !</h1>
                    <p class="home__description">
                        BROWSE TALENT BY CATEGORY AND FIND GREAT WORK
                    </p>
                    <a href="login/join_as.php" class="button button__flex" style="border-radius: 12px;">
                        Let's Start <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
                <div class="home__images">
                    <img src="img/programming3.png" alt="home image" class="home__img">

                    <div class="home__triangle home__triangle-3"></div>
                    <div class="home__triangle home__triangle-2"></div>
                    <div class="home__triangle home__triangle-1"></div>
                </div>
            </div>
        </section>
        
        <!--==== Join Us ====-->
        <section class="join section" id="join">
            <div class="container">
                <div class="section__data">
                    <h2 class="section__subtitle">Join Us right now !</h2>
                    <div class="section__titles">
                        <h1 class="section__title-border">Go wherever your</h1>
                        <h1 class="section__title">Imagination takes you.</h1>
                    </div>
                </div>

                <div class="join__container grid">
                    <article class="join__card">
                        <div class="join__shape">
                            <img src="img/Freelancer.png" alt="join image" class="join__img">
                        </div>

                        <h3 class="join__title">Freelancer</h3>

                        <p class="join__description">
                            Register & Find a job
                        </p>

                        <a href="login/join_as.php" class="join__button">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </article>

                    <article class="join__card">
                        <div class="join__shape">
                            <img src="img/client.png" alt="join image" class="join__img">
                        </div>

                        <h3 class="join__title">Client</h3>

                        <p class="join__description">
                            Register & Hire a freelancer
                        </p>

                        <a href="login/join_as.php" class="join__button">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </article>


                </div>
            </div>
            <br>
        </section>

        <!--==== Statistics ====-->
        <section class="statistics section" id="statistics">
            <div class="section__data">
                <h2 class="section__subtitle">Statistics</h2>
            </div>

            <div class="statistics__section">
                <ul class="box-info">
                    <li>
                        <i class="fas fa-sharp fa-solid fa-users"></i>
                        <span class="text">
                            <h3><?php echo intval($freelancers_count); ?></h3>
                            <p>Freelancers</p>
                        </span>
                    </li>
                    
                    <li>
                        <i class="fas fa-duotone fa-users"></i>
                        <span class="text">
                            <h3><?php echo intval($clients_count); ?></h3>
                            <p>Clients</p>
                        </span>
                    </li>
                    
                    <li>
                        <i class="fas fa-duotone fa-list"></i>
                        <span class="text">
                            <h3><?php echo intval($jobs_count); ?></h3>
                            <p>Jobs Posted</p>
                        </span>
                    </li>
                </ul>
            </div>
        </section>
    </main>


    <!--=============== FOOTER ===============-->
    <footer class="footer section" id="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help & Support</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <br><br><br><br>
            <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
        </div>
    </footer>


    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up" style="border-radius: 10px;">
        <i class="ri-arrow-up-line"></i>
    </a>


    <!--=============== SCROLL REVEAL ===============-->
    <script src="Js/scrollreveal.min.js"></script>


    <!--=============== JS ===============-->
    <script src="JS/main.js"></script>

</body>
</html>