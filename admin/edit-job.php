<?php
    session_start();

    @include '../login/config.php';

    $id = $_GET['idad'];

    if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $budget = $_POST['budget'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        $job_status = $_POST['job_status'];

        $sql = "UPDATE jobs SET title='$title', type='$type', category='$category', budget='$budget',
                time='$time', description='$description', job_status='$job_status'
                WHERE id_job = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: jobs.php");
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
    <title>Edit Job</title>

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
                <a href="jobs.php" class="name_page">Edit Job</a>

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
        <div class="container" style="border: 1px solid rgb(211, 193, 193); padding: 2rem; margin: 85px 180px; max-width: 680px;">
            <div class="text-center mb-4 fs-6">
                <h3>Edit Job Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <?php
                $sql = "SELECT * from jobs where id_job = $id LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            ?>

            <div class="container d-flex justify-content-center">
                <form method="post" style="width: 50vw;">
                    <div class="form-group mb-3">
                        <small class="text-muted mt-2">Job Title :</small>
                        <textarea name="title" class="form-control" rows="3"><?php  echo $row['title'] ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                        <small class="text-muted mt-2">Job Type :</small>
                        <select class="form-control" name="type">
                            <option value="" selected>Select job type...</option>
                            <option value="Hourly project" <?php if ($row['type'] == 'Hourly project') { echo 'selected'; } ?>>Hourly project</option>
                            <option value="Full-Time" <?php if ($row['type'] == 'Full-Time') { echo 'selected'; } ?>>Full-Time</option>
                            <option value="Part-Time" <?php if ($row['type'] == 'Part-Time') { echo 'selected'; } ?>>Part-Time</option>
                            <option value="Fixed-Price" <?php if ($row['type'] == 'Fixed-Price') { echo 'selected'; } ?>>Fixed-Price</option>
                            <option value="Contract" <?php if ($row['type'] == 'Contract') { echo 'selected'; } ?>>Contract</option>
                            <option value="Flexible" <?php if ($row['type'] == 'Flexible') { echo 'selected'; } ?>>Flexible</option>
                            <option value="Other" <?php if ($row['type'] == 'Other') { echo 'selected'; } ?>>Other</option>
                        </select>
                        </div>

                        <div class="col form-group">
                            <small class="text-muted mt-2">Job Category :</small>
                            <select class="form-control" name="category">
                                <option value="" selected>Select job category...</option>
                                <option value="Web Development" <?php if ($row['category'] == 'Web Development') { echo 'selected'; } ?>>Web Development</option>
                                <option value="Mobile Development" <?php if ($row['category'] == 'Mobile Development') { echo 'selected'; } ?>>Mobile Development</option>
                                <option value="Sales & Marketing" <?php if ($row['category'] == 'Sales & Marketing') { echo 'selected'; } ?>>Sales & Marketing</option>
                                <option value="Graphic Design" <?php if ($row['category'] == 'Graphic Design') { echo 'selected'; } ?>>Graphic Design</option>
                                <option value="Writing" <?php if ($row['category'] == 'Writing') { echo 'selected'; } ?>>Writing</option>
                                <option value="Data Entry" <?php if ($row['category'] == 'Data Entry') { echo 'selected'; } ?>>Data Entry</option>
                                <option value="Accounting & Consulting" <?php if ($row['category'] == 'Accounting & Consulting') { echo 'selected'; } ?>>Accounting & Consulting</option>
                                <option value="Admin Support" <?php if ($row['category'] == 'Admin Support') { echo 'selected'; } ?>>Admin Support</option>
                                <option value="IT & Networking" <?php if ($row['category'] == 'IT & Networking') { echo 'selected'; } ?>>IT & Networking</option>
                                <option value="Customer Service" <?php if ($row['category'] == 'Customer Service') { echo 'selected'; } ?>>Customer Service</option>
                                <option value="Translation" <?php if ($row['category'] == 'Translation') { echo 'selected'; } ?>>Translation</option>
                                <option value="Engineering & Architecture" <?php if ($row['category'] == 'Engineering & Architecture') { echo 'selected'; } ?>>Engineering & Architecture</option>
                                <option value="Social Media Management" <?php if ($row['category'] == 'Social Media Management') { echo 'selected'; } ?>>Social Media Management</option>
                                <option value="Video & Animation" <?php if ($row['category'] == 'Video & Animation') { echo 'selected'; } ?>>Video & Animation</option>
                                <option value="Music & Audio" <?php if ($row['category'] == 'Music & Audio') { echo 'selected'; } ?>>Music & Audio</option>
                                <option value="Legal" <?php if ($row['category'] == 'Legal') { echo 'selected'; } ?>>Legal</option>
                                <option value="Other" <?php if ($row['category'] == 'Other') { echo 'selected'; } ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col input-group mt-3">
                            <div class="input-group-prepend">
                                <small class="text-muted input-group-text">Budget :</small>
                            </div>
                            <input type="number" step="1" min="0" class="form-control" name="budget" value="<?php echo $row['budget'] ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                        </div>

                        <div class="col input-group mt-3">
                            <div class="input-group-prepend">
                                <small class="text-muted input-group-text">Time :</small>
                            </div>
                            <input type="number" class="form-control" name="time" step="1" min="0" value="<?php echo $row['time']; ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text">days</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <small class="text-muted mt-2">Job Description :</small>
                        <textarea class="form-control" rows="3" name="description"><?php  echo $row['description'] ?></textarea>
                    </div>

                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <small class="text-muted input-group-text">Job Status :</small>
                        </div>
                        <select class="form-control" name="job_status">
                            <option value="" selected>Select job status...</option>
                            <option value="public" <?php if($row['job_status'] == 'public') echo 'selected'; ?>>Public</option>
                            <option value="private" <?php if($row['job_status'] == 'private') echo 'selected'; ?>>Private</option>
                            <option value="completed" <?php if($row['job_status'] == 'completed') echo 'selected'; ?>>Completed</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary mx-2" name="submit">Update</button>
                        <button type="button" class="btn btn-danger mx-2" onclick="window.location.href='jobs.php'">Close</button>
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
