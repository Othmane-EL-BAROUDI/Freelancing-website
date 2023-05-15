<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id_client = $_SESSION['client_id'];

    $sql="SELECT * FROM client WHERE id_client = '$id_client'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req);

    // Check if the job ID is set
    if(isset($_GET['id_job'])) {
        // Retrieve the job details from the database
        $job_id = $_GET['id_job'];
        $query = "SELECT * FROM jobs WHERE id_job = $job_id";
        $result = mysqli_query($conn, $query);
        $job = mysqli_fetch_assoc($result);
    }
    
    // Check if the form is submitted
    if(isset($_POST['submit'])) {
        // Get the form data
        $title = $_POST['title'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $budget = $_POST['budget'];
        $description = $_POST['description'];
        $time = $_POST['time'];

        // Check if the job ID is set
        if(isset($_GET['id_job'])) {
            // Update the job in the database
            $job_id = $_GET['id_job'];
            $query = "UPDATE jobs SET title='$title', type='$type', category='$category', budget=$budget, description='$description', time=$time WHERE id_job=$job_id";
            mysqli_query($conn, $query);

            // Redirect to the my-jobs.php page
            header('Location: my-jobs.php');
            exit();
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs</title>

    <!--=============== SHORTCUT ICON ===============-->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    
    <!--=============== Font awesome cdn link ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!--=============== Custom css file link ===============-->
    <link rel="stylesheet" href="CSS/style.css">

    <!--=============== The following jQuery code helps to hide or show the popup dialog box ===============-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".job-status-form").submit(function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "my-jobs.php",
                    data: form_data,
                    success: function(response) {
                    alert("Job status updated successfully.");
                    },
                    error: function(xhr, status, error) {
                    alert("An error occurred while updating job status.");
                    }
                });
            });
        });
    </script>

</head>
<body>

    <!--=============== Header section STARTS ===============-->
    <header class="header">
        <section class="flex">
            <a href="my-jobs.php" class="logo">Edit Job</a>

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


    <!--=============== Edit Job section STARTS ===============-->
    <section>
        <div class="">
            <div class="modal-content animate-top">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">×</span>
                </button>

                <h3 class="heading">Edit Your Job</h3>

                <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . http_build_query(array('id_job' => $job_id)); ?>" method="post">

                    <input type="text" name="title" required maxlength="50" placeholder="Enter title" class="booxx" autocomplete="off" value="<?php echo $job['title']; ?>">

                    <select required class="booxx" name="type" autocomplete="off">
                        <option value="">Select job type...</option>
                        <option value="Hourly project" <?php if($job['type'] == 'Hourly project') echo 'selected'; ?>>Hourly project</option>
                        <option value="Full-Time" <?php if($job['type'] == 'Full-Time') echo 'selected'; ?>>Full-Time</option>
                        <option value="Part-Time" <?php if($job['type'] == 'Part-Time') echo 'selected'; ?>>Part-Time</option>
                        <option value="Fixed-Price" <?php if($job['type'] == 'Fixed-Price') echo 'selected'; ?>>Fixed-Price</option>
                        <option value="Contract" <?php if($job['type'] == 'Contract') echo 'selected'; ?>>Contract</option>
                        <option value="Flexible" <?php if($job['type'] == 'Flexible') echo 'selected'; ?>>Flexible </option>
                        <option value="Other"  <?php if($job['type'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>

                    <select name="category" class="booxx" required autocomplete="off">
                        <option value="">Select job category...</option>
                        <option value="Web Development" <?php if($job['category'] == 'Web Development') echo 'selected'; ?>>Web Development</option>
                        <option value="Mobile Development" <?php if($job['category'] == 'Mobile Development') echo 'selected'; ?>>Mobile Development</option>
                        <option value="Sales & Marketing" <?php if($job['category'] == 'Sales & Marketing') echo 'selected'; ?>>Sales & Marketing</option>
                        <option value="Graphic Design" <?php if($job['category'] == 'Graphic Design') echo 'selected'; ?>>Graphic Design</option>
                        <option value="Writing" <?php if($job['category'] == 'Writing') echo 'selected'; ?>>Writing</option>
                        <option value="Data Entry" <?php if($job['category'] == 'Data Entry') echo 'selected'; ?>>Data Entry</option>
                        <option value="Accounting & Consulting" <?php if($job['category'] == 'Accounting & Consulting') echo 'selected'; ?>>Accounting & Consulting</option>
                        <option value="Admin Support" <?php if($job['category'] == 'Admin Support') echo 'selected'; ?>>Admin Support</option>
                        <option value="IT & Networking" <?php if($job['category'] == 'IT & Networking') echo 'selected'; ?>>IT & Networking</option>
                        <option value="Customer Service" <?php if($job['category'] == 'Customer Service') echo 'selected'; ?>>Customer Service</option>
                        <option value="Translation" <?php if($job['category'] == 'Translation') echo 'selected'; ?>>Translation</option>
                        <option value="Engineering & Architecture" <?php if($job['category'] == 'Engineering & Architecture') echo 'selected'; ?>>Engineering & Architecture</option>
                        <option value="Social Media Management" <?php if($job['category'] == 'Social Media Management') echo 'selected'; ?>>Social Media Management</option>
                        <option value="Video & Animation" <?php if($job['category'] == 'Video & Animation') echo 'selected'; ?>>Video & Animation</option>
                        <option value="Music & Audio" <?php if($job['category'] == 'Music & Audio') echo 'selected'; ?>>Music & Audio</option>
                        <option value="Legal" <?php if($job['category'] == 'Legal') echo 'selected'; ?>>Legal</option>
                        <option value="Other" <?php if($job['category'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>

                    <input type="number" name="budget" required maxlength="50" placeholder="Enter Budget($)" class="booxx" min="0" step="1" autocomplete="off" value="<?php echo $job['budget']; ?>">

                    <textarea name="description" class="booxx" placeholder="Enter job description" maxlength="1000" cols="30" rows="10" autocomplete="off"><?php echo $job['description']; ?></textarea>
                    
                    <input type="number" name="time" required maxlength="50" placeholder="Delivery Time (days)" class="booxx" min="1" step="1" autocomplete="off" value="<?php echo $job['time']; ?>">
                    
                    <input type="submit" value="Update" name="submit" class="contact-form-btttn">
                </form>
            </div>
        </div>
    </section>
    <script>
        const closeButton = document.getElementById('close-button');
        closeButton.addEventListener('click', () => {
        window.location.href = 'my-jobs.php';
        });
    </script>
    <!--=============== Edit Job section ENDS ===============-->


    <!--=============== Footer section STARTS ===============-->
    <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer>
    <!--=============== Footer section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>
</html>