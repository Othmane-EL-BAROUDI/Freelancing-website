<?php
    session_start();

    @include '../login/config.php';

    if(isset($_POST['submit'])) {
        $first_name_admin = $_POST['first_name_admin'];
        $last_name_admin = $_POST['last_name_admin'];
        $email_admin = $_POST['email_admin'];
        $password_admin = $_POST['password_admin'];

        $sql = "INSERT INTO admin (`first_name_admin`, `last_name_admin`, `email_admin`, `password_admin`)
        VALUES ('$first_name_admin','$last_name_admin','$email_admin','$password_admin')";

        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: admins.php"); // header("Location: admins.php?msg=New admin account created successfully");
        }else{
            echo "Failed: " . mysqli_error($conn);
        }
    }

    if(isset($_GET['delete_id'])) {

        $id = $_GET['delete_id'];

        $sql = "DELETE FROM admin WHERE id_admin = $id";
        $result = mysqli_query($conn, $sql);

        header('Location: admins.php');
        exit();
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
    <title>Manage Admins</title>

    <!--=============== SHORTCUT ICON ===============-->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/style.css" />

    <!--=============== Font awesome cdn link ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!--=============== Bootstrap CSS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="grid-container">
        <!--=============== Navbar section | START ===============-->
        <section>
            <nav>
                <a href="admins.php" class="name_page">Admins</a>

                <form action="#" method="get">
                    <div class="form-group">
                        <input type="text" name="search_box" placeholder="Search..." autocomplete="off">
                        <button type="submit" class="fa-solid fa-magnifying-glass icon" style="border: none; background: transparent;"></button>
                    </div>
                </form>

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


        <!--=============== Add Admin section | START ===============-->
        <section>            
            <form action="" method="post">
                <!-- Modal -->
                <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">New Admin</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="completefirstname" class="form-label">First name</label>
                                    <input name="first_name_admin" type="text" class="form-control" id="completefirstname" placeholder="Enter first name..." autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    <label for="completelastname" class="form-label">Last name</label>
                                    <input name="last_name_admin" type="text" class="form-control" id="completelastname" placeholder="Enter last name..." autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    <label for="completeemail" class="form-label">Email</label>
                                    <input name="email_admin" type="email" class="form-control" id="completeemail" placeholder="Enter email..." autocomplete="off">
                                </div>

                                <div class="mb-3">
                                    <label for="completepassword" class="form-label">Password</label>
                                    <input name="password_admin" type="password" class="form-control" id="completepassword" placeholder="Enter password..." autocomplete="off">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!--=============== Add Admin section | END ===============-->


        <!--=============== Admins section | START ===============-->
        <section>
            <?php
                // if(isset($_GET['msg'])){
                //     $msg = $_GET['msg'];
                //     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-left: -350px; width: 310%; table-layout: fixed;">
                //             '.$msg.'
                //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                //                 <span aria-hidden="true">&times;</span>
                //             </button>
                //         </div>';
                // }
            ?>

            <div class="container">
                <div class="d-flex justify-content-start mb-2">
                    <button type="button" class="btn btn-dark my-2 ms-5" data-bs-toggle="modal" data-bs-target="#completeModal">
                        Add New Admin
                    </button>
                </div>
            </div>

            <table class="table table-hover text-center" style="margin-left: -350px; width: 310%; table-layout: fixed;">
                <colgroup>
                    <col style="width: 5%">
                    <col style="width: 18%">
                    <col style="width: 18%">
                    <col style="width: 35%">
                    <col style="width: 20%">
                    <col style="width: 10%">
                </colgroup>
                <thead style="background-color: #dadfe4;">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['search_box'])) {
                            $search_query = mysqli_real_escape_string($conn, $_GET['search_box']);
                            $sql1 = "SELECT * FROM admin WHERE CONCAT(first_name_admin, ' ', last_name_admin) LIKE '%$search_query%' OR id_admin LIKE '%$search_query%'";
                        } else {
                            $sql1 = "SELECT * FROM admin";
                        }
                    
                        $result1 = mysqli_query($conn, $sql1);
                        while($row = mysqli_fetch_assoc($result1)){
                            ?>
                                <tr>
                                    <td><?php echo $row['id_admin'] ?></td>
                                    <td><?php echo $row['first_name_admin'] ?></td>
                                    <td><?php echo $row['last_name_admin'] ?></td>
                                    <td><?php echo $row['email_admin'] ?></td>
                                    <td><?php echo $row['password_admin'] ?></td>
                                    <td>
                                        <a href="edit-admin.php?idad=<?php echo $row['id_admin']; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                        <a href="?delete_id=<?php echo $row['id_admin']; ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                                    </td>
                                </tr>
                            <?php 
                        }
                    ?>
                </tbody>
            </table>
        </section>
        <!--=============== Admins section | END ===============-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
