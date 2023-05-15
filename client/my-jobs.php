<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id_client = $_SESSION['client_id'];

    $sql="SELECT * FROM client WHERE id_client = '$id_client'  ";
    $req = mysqli_query($conn , $sql) ;
    $num_ligne = mysqli_fetch_assoc($req) ;

    if(isset($_GET['delete_id'])) {
        $conn = mysqli_connect('localhost','root','','lancer');

        $id = $_GET['delete_id'];

        $sql = "DELETE FROM jobs WHERE id_job = $id";
        $result = mysqli_query($conn, $sql);

        header('Location: my-jobs.php');
        exit();
    }

    $query = "SELECT suivi_job.id_job, suivi_job.status FROM suivi_job WHERE suivi_job.id_client = '$id_client'";

    $results = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($results)) {
        // Update job_status based on the status in suivi_job
        switch ($row['status']) {
            case 'pending':
                $job_status = 'public';
                break;
            case 'accepted':
                $job_status = 'private';
                break;
            case 'rejected':
                $job_status = 'public';
                break;
            case 'completed':
                $job_status = 'completed';
                break;
            default:
                $job_status = null;
        }

        if (!is_null($job_status)) {
            $job_id = $row['id_job'];
            $update_query = "UPDATE jobs SET job_status='$job_status' WHERE id_job='$job_id'";
            mysqli_query($conn, $update_query);
        }
    }

    mysqli_close($conn);
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

    <script>
        function editJob() {
            var job_id = $(this).data("id");
            window.location.href = "edit-job.php?id_job=" + job_id;
        }

        $(document).ready(function () {
            // Handle edit button clicks
            $("button[id^='edit-job-btn-']").click(editJob);
        });
    </script>

</head>
<body>

    <!--=============== Header section STARTS ===============-->
    <header class="header">
        <section class="flex">
            <a href="my-jobs.php" class="logo">My Job Listings</a>

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


    <!--=============== My Jobs section STARTS ===============-->
    <section>
        <div class="jobs">
            <div class="job-container">
                <?php
                // Retrieve jobs again after updating the job status in jobs table
                $conn = mysqli_connect("localhost", "root", "", "lancer");
                $query = "SELECT * FROM jobs WHERE id_client = '$id_client'";
                $results = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($results)) { ?>
                    <div class="boox jb">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <div class="box">
                            <p><span class="category-label">Type :</span> <?php echo $row['type']; ?><span class="category-label" style="margin-left: 233px;">Category :</span> <?php echo $row['category']; ?></p>
                            <p><span class="category-label">Budget :</span> <?php echo $row['budget']; ?>$<span class="category-label" style="margin-left: 253px;">Delivery Time :</span> <?php echo $row['time']; ?> days</p>
                        </div>
                        
                        <form class="job-status-form">
                            <input type="text" name="status" class="job-status-input" value="<?php 
                                switch ($row['job_status']) {
                                    case 'private':
                                        echo 'Private';
                                        break;
                                    case 'completed':
                                        echo 'Completed';
                                        break;
                                    default:
                                    echo 'Public';
                                }
                            ?>" readonly>
                            <input type="hidden" name="job_id" value="<?php echo $row['id_job']; ?>">
                        </form>

                        <?php if ($row['job_status'] == 'private' || $row['job_status'] == 'completed') {
                            if ($row['job_status'] == 'private') {
                                $alert_message = 'Sorry, this job is currently in progress and cannot be edited or deleted at this time.';
                            } else {
                                $alert_message = 'Sorry, this job has already been completed and cannot be edited or deleted.';
                            }
                        ?>
                            <button class="inline-btnn mr-2 disabled" style="background-color: #dcdcdc; cursor: pointer;" onclick="alert('<?php echo $alert_message; ?>')"><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                            <button class="inline-btnn disabled" style="background-color: #dcdcdc; cursor: pointer;" onclick="alert('<?php echo $alert_message; ?>')"><i class="fa-solid fa-xmark"></i></button>
                        <?php } else { ?>
                            <button class="inline-btnn mr-2" id="edit-job-btn-<?php echo $row['id_job']; ?>" data-id="<?php echo $row['id_job']; ?>"><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                            <a href="?delete_id=<?php echo $row['id_job']; ?>" class="inline-btnn"><i class="fa-solid fa-xmark"></i></a>
                        <?php } ?>
                        
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <script>
        document.getElementById("edit-job-btn").addEventListener("click", function() {
            var jobId = this.getAttribute("data-id");
            window.location.href = "edit-job.php?id=" + jobId;
        });
    </script>
    <!--=============== My Jobs section ENDS ===============-->


    <!--=============== Footer section STARTS ===============-->
    <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer>
    <!--=============== Footer section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>
</html>