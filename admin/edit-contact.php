<?php
    session_start();

    @include '../login/config.php';

    $id = $_GET['idad'];

    if(isset($_POST['submit'])) {
        $first_name_contact = $_POST['first_name_contact'];
        $last_name_contact = $_POST['last_name_contact'];
        $email_contact = $_POST['email_contact'];
        $subject_contact = $_POST['subject_contact'];
        $message_contact = $_POST['message_contact'];

        $sql = "UPDATE contact_us SET first_name_contact='$first_name_contact', last_name_contact='$last_name_contact', email_contact='$email_contact', subject_contact='$subject_contact', message_contact='$message_contact' WHERE id_contact = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: contact-us.php");
        }else{
            echo "Failed: " . mysqli_error($conn);
        }
    }
    
    $id_admin = $_SESSION['admin_id'];

    $sql="SELECT * FROM admin WHERE id_admin = '$id_admin'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Contact Us</title>

    <!--=============== SHORTCUT ICON ===============-->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/style.css" />

    <!--=============== Font awesome cdn link ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!--=============== Bootstrap CSS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="grid-container">
        <!--=============== Navbar section | START ===============-->
        <section>
            <nav>
                <a href="contact-us.php" class="name_page">Edit Contact Us</a>

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


        <!--=============== Edit Admin section | START ===============-->
        <div class="container" style="border: 1px solid rgb(211, 193, 193); padding: 2.2rem; margin: 85px 280px; max-width: 600px;">
            <div class="text-center mb-4 fs-6">
                <h3>Edit Contact Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <?php
                $sql = "SELECT * from contact_us where id_contact = $id LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?>

            <div class="container d-flex justify-content-center">
                <form method="post" style="width: 50vw;">
                    <div class="row mt-4">
                        <div class="col">
                            <small class="text-muted mt-2">First name :</small>
                            <input name="first_name_contact" type="text" class="form-control" value = "<?php  echo $row['first_name_contact'] ?>">
                        </div>

                        <div class="col">
                            <small class="text-muted mt-3">Last name :</small>
                            <input name="last_name_contact" type="text" class="form-control" value = "<?php  echo $row['last_name_contact'] ?>">
                        </div>
                    </div>

                    <div class="mt-4">
                        <small class="text-muted mt-2">Email :</small>
                        <input name="email_contact" type="email" class="form-control" value = "<?php  echo $row['email_contact'] ?>">
                    </div>

                    <div class="mt-4">
                        <small class="text-muted mt-2">Password :</small>
                        <input name="subject_contact" type="text" class="form-control" value = "<?php  echo $row['subject_contact'] ?>">
                    </div>

                    <div class="form-group mt-4">
                        <small class="text-muted mt-2">Contact Message :</small>
                        <textarea class="form-control" rows="3" name="message_contact"><?php  echo $row['message_contact'] ?></textarea>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary mx-2" name="submit">Update</button>
                        <button type="button" class="btn btn-danger mx-2" onclick="window.location.href='contact-us.php'">Close</button>
                    </div>
                </form>
            </div>
        </div>
        <!--=============== Edit Admin section | END ===============-->
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

    <!--=============== Bootstrap JS ===============-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
