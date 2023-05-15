<?php
    session_start();
    @include 'config.php';

    $pdo = new PDO('mysql:host=localhost;dbname=lancer','root','');

    $freelancer_id = $_SESSION['freelancer_id'];
    
    $sqlstate = $pdo->prepare('SELECT * FROM reviews 
                               INNER JOIN client ON reviews.id_client = client.id_client 
                               INNER JOIN freelancer ON reviews.id_freelancer = freelancer.id_freelancer 
                               WHERE freelancer.id_freelancer = :freelancer_id');
    
    $sqlstate->bindValue(':freelancer_id', $freelancer_id, PDO::PARAM_INT);
    $sqlstate->execute();
    $jobs = $sqlstate->fetchAll(PDO::FETCH_ASSOC);
        
    if(!isset($_SESSION['freelancer_name'])){
        header('location:login_form.php');
     }
        $sell = "SELECT * FROM freelancer ";
        $qyerry= mysqli_query($conn, $sell);
      $resul = mysqli_fetch_assoc($qyerry);


      $sqlstate = $pdo ->prepare('select * FROM reviews INNER JOIN client on client.id_client=reviews.id_client');

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
                <a href="Reviews.php" class="logo">Reviews</a>
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
                            <img src="img/originals/First place medal-60b6.png" alt="">
                        </div>
                </div>
                <div class="box">
                            <h2 class="title">REVIEWS</h2>
                            <p class="tutor">All clients reviews that you have worked with </p>
                            <hr>
                </div>
            </section>


            <section class="review-list">
            <?php foreach($jobs as $jobs){
                ?>
                <div class="review">
                    <div class="reviewer-info">
                                <?php   
                                    if($jobs['statut']==0)  {
                                        echo '<img src="photoclient/default.jpg">' ;
                                    } 
                                    else{
                                    $id = $jobs['id_client'];
                                        $ex=$jobs['exentation'];
                                        $namf=$id.'.'.$ex;
                                        echo ' <img src="photoclient/'.$namf.'">';
                                    }
                                ?>
                        <div class="reviewer-name">
                        <h3><?php echo $jobs['first_name_cli'] . ' ' . $jobs['last_name_cli']; ?></h3>
                        <p>Customer</p>
                        </div>
                    </div>
                    <div class="review-content">
                        <div class="stars"?>
                        <h4> <?php echo $jobs['rating'];?>  <i class="fa fa-star"></i> </h4>
                        </div>
                        <p><?php echo $jobs['description'] ?></p>
                    </div>
                </div>
                <?php
            }?>
            </section>


            <!--js   -->
        <script src="js/script2.js"></script>

    </body>
</html>