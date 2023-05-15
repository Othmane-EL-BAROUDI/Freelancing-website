<?php
    session_start();

    @include '../login/config.php';

    if (isset($_POST['submit'])) {
        
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        $client_id = $_SESSION['client_id'];

        $query = "UPDATE client SET first_name_cli = '$first_name', last_name_cli = '$last_name', email_client = '$email' WHERE id_client = '$client_id'";
        mysqli_query($conn, $query);

        $current_password = mysqli_real_escape_string($conn, md5($_POST['current_password']));
        $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
        $repeat_new_password = mysqli_real_escape_string($conn, md5($_POST['repeat_new_password']));

        if(!empty($current_password) || !empty($new_password) || !empty($repeat_new_password)){
            $old_pass = $_POST['old_pass'];
            if($current_password != $old_pass){
                $message[] = 'old password not matched!';
            }elseif($new_password != $repeat_new_password){
                $message[] = 'confirm password not matched!';
            }else{
                mysqli_query($conn, "UPDATE client SET password_client = '$repeat_new_password' WHERE id_client = '$client_id'") or die('query failed');
                $message[] = 'password updated successfully!';
            }
        }

        header("Location: profile.php");
        exit();
    }

    $client_id = $_SESSION['client_id'];
    $select = mysqli_query($conn, "SELECT * FROM client WHERE id_client = '$client_id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
    }
    
    $query = "SELECT first_name_cli, last_name_cli, email_client FROM client WHERE id_client = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email);
    $stmt->fetch();
    $stmt->close();
?>

<?php
    $ex=$fetch['exentation'];

    if(isset( $_FILES['cr']["name"])){
        if ($fetch['statut'] == 1) {
            unlink('C:\xampp\htdocs\lancer\client\photoclient\\'.$client_id.'.'.$ex);
        }
        $fileType = $_FILES['cr']["type"];
        $fileData =  $_FILES['cr']["tmp_name"];
        $sizeData =  $_FILES['cr']["size"];
        $fileName= $_FILES['cr']["name"];
        $fileNameParts = explode('.', $fileName);
        $ext = end($fileNameParts);
        $nemnew=$client_id.'.'.$ext;
        $n=1;

        if($ext=='jpg' || $ext=='jpge'  || $ext=='png'  ){
            $sql9= "UPDATE client set statut='$n', exentation='$ext' where id_client='$client_id'";
            $result4 = mysqli_query($conn, $sql9 );
            move_uploaded_file($fileData,'C:\xampp\htdocs\lancer\client\photoclient\\'.$nemnew);
        }else{
            echo "error upload photo";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

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
            <a href="profile.php" class="logo">Profile</a>

            <div class="icons">
                <div id="menu-btn" class="fa-sharp fa-solid fa-bell"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

            <div class="profile">
                <?php   
                    if($fetch['statut'] == 0){
                        echo '<img class="image" src="photoclient/default.jpg">';
                    }
                    else{
                        $ex = $fetch['exentation'];
                        $namf = $client_id.'.'.$ex;
                        echo '<img class="image" src="photoclient/'.$namf.'">';
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


    <!--=============== Setting section STARTS ===============-->
    <form action="" method="POST" enctype="multipart/form-data">
        <section>
            <div class="headline">
                <h3><i class="fa-regular fa-circle-user"></i> My Account</h3>
            </div>

            <div class="section-wrapper">
                <div class="avatar-wrapper" style="margin-left: 18px;">
                    <!-- <img class="profile-pic" src="img/pic-1.jpg" alt="" /> -->
                    <?php   
                        if($fetch['statut']==0)  {
                            echo '<img class="profile-pic" src="photoclient/default.jpg">' ;
                        } 
                        else{
                            $ex=$fetch['exentation'];
                            $namf=$client_id.'.'.$ex;
                            echo ' <img class="profile-pic" src="photoclient/'.$namf.'">';
                        }
                    ?>
                </div>

                <div class="fields" style="margin-top: -18px;">
                    <div class="infos">
                        <h5>Upload new profile picture</h5>
                        <input type="file" name="cr">
                        <button class="inline-btn" type="submit" name="sub" value="send" style="font-size: 1rem; padding: .95rem 1.2rem; font-weight: 900;">Update</button>
                    </div>
                </div>
            </div>

            <div class="section-wrapper" style="margin-bottom: 50px;">
                <div class="infos">
                    <div class="fields">
                        <div class="field-submit">
                            <h5>First Name</h5>
                            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                        </div>
                                
                        <div class="field-submit">
                            <h5>Last Name</h5>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                        </div>
                        
                        <div class="field-submit">
                            <h5>Email</h5>
                            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" style="width: 350px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section style="padding-top: 0;">
            <div class="headline" style="margin-bottom: -30px;">
                <h3><i class="fa-solid fa-lock"></i> Password & Security</h3>
            </div>

            <div class="section-wrapper">
                <div class="infos">
                    <div class="fields">
                        <input type="hidden" name="old_pass" value="<?php echo $fetch['password_client']; ?>">

                        <div class="field-submit">
                            <h5>Current Password</h5>
                            <input type="password" name="current_password">
                        </div>
                        
                        <div class="field-submit">
                            <h5>New Password</h5>
                            <input type="password" name="new_password">
                        </div>
                        
                        <div class="field-submit">
                            <h5>Repeat New Password</h5>
                            <input type="password" name="repeat_new_password">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="btn-container">
            <input name="submit" type="submit" class="inline-btn" value="Save Changes">
        </div>
    </form>
    <!--=============== Setting section ENDS ===============-->


    <!--=============== Footer section STARTS ===============-->
    <footer class="footer">
        <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
    </footer>
    <!--=============== Footer section ENDS ===============-->


    <!--=============== Custom js file link ===============-->
    <script src="JS/script.js"></script>

</body>
</html>
