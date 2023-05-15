<?php
    session_start();

    @include '../login/config.php';

    $id_admin = $_SESSION['admin_id'];

    if (isset($_POST['submit'])) {
        
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        $query = "UPDATE admin SET first_name_admin = '$first_name', last_name_admin = '$last_name', email_admin = '$email' WHERE id_admin = '$id_admin'";
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
                mysqli_query($conn, "UPDATE admin SET password_admin = '$repeat_new_password' WHERE id_admin = '$id_admin'") or die('query failed');
                $message[] = 'password updated successfully!';
            }
        }

        header("Location: profile.php");
        exit();
    }

    $select = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
    }
    
    $query = "SELECT first_name_admin, last_name_admin, email_admin FROM admin WHERE id_admin = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_admin);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email);
    $stmt->fetch();
    $stmt->close();
?>

<?php
    $ex=$fetch['exentation'];

    if(isset( $_FILES['cr']["name"])){
        if ($fetch['statut'] == 1) {
            unlink('C:\xampp\htdocs\lancer\admin\photoadmin\\'.$id_admin.'.'.$ex);
        }
        $fileType = $_FILES['cr']["type"];
        $fileData =  $_FILES['cr']["tmp_name"];
        $sizeData =  $_FILES['cr']["size"];
        $fileName= $_FILES['cr']["name"];
        $fileNameParts = explode('.', $fileName);
        $ext = end($fileNameParts);
        $nemnew=$id_admin.'.'.$ext;
        $n=1;

        if($ext=='jpg' || $ext=='jpge'  || $ext=='png'  ){
            $sql9= "UPDATE admin set statut='$n', exentation='$ext' where id_admin='$id_admin'";
            $result4 = mysqli_query($conn, $sql9 );
            move_uploaded_file($fileData,'C:\xampp\htdocs\lancer\admin\photoadmin\\'.$nemnew);
        }else{
            echo "error upload photo";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>

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
                <a href="profile.php" class="name_page">Profile</a>

                <div class="profile">
                    <?php   
                            if($fetch['statut']==0)  {
                                echo '<img class="profile-pic" src="photoadmin/default.jpg">' ;
                            } 
                            else{
                                $ex=$fetch['exentation'];
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


        <!--=============== Profile section | START ===============-->
        <form action="" method="POST" enctype="multipart/form-data">
            <section style="padding-bottom: 25px;">
                <div class="headline">
                    <h3><i class="fa-regular fa-circle-user"></i> My Account</h3>
                </div>

                <div class="section-wrapper">
                    <div class="avatar-wrapper" style="margin-left: 18px;">
                        <!-- <img class="profile-pic" src="img/pic-1.jpg" alt="" /> -->
                        <?php   
                            if($fetch['statut']==0)  {
                                echo '<img class="profile-pic" style="height: 85%; width: 85%;" src="photoadmin/default.jpg">' ;
                            }
                            else{
                                $ex=$fetch['exentation'];
                                $namf=$id_admin.'.'.$ex;
                                echo ' <img class="profile-pic" style="height: 85%; width: 85%;" src="photoadmin/'.$namf.'">';
                            }
                        ?>
                    </div>

                    <div class="fields">
                        <div class="infos">
                            <h5>Upload new profile picture</h5>
                            <input type="file" name="cr">
                            <button class="inline-btn" type="submit" name="sub" value="send" style="font-size: .9rem; padding: .1rem .2rem; font-weight: 600; cursor: pointer;">Update</button>
                        </div>
                    </div>
                </div>

                <div class="section-wrapper">
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
            
            <section>
                <div class="headline" style="padding-top: 0;">
                    <h3><i class="fa-solid fa-lock"></i> Password & Security</h3>
                </div>

                <div class="section-wrapper">
                    <div class="infos">
                        <div class="fields">
                            <input type="hidden" name="old_pass" value="<?php echo $fetch['password_admin']; ?>">

                            <div class="field-submit">
                                <h5>Current Password</h5>
                                <input type="password" name="current_password" style="width: 100%;">
                            </div>
                            
                            <div class="field-submit">
                                <h5>New Password</h5>
                                <input type="password" name="new_password" style="width: 100%;">
                            </div>
                            
                            <div class="field-submit">
                                <h5>Repeat New Password</h5>
                                <input type="password" name="repeat_new_password" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="btn-container">
                <input name="submit" type="submit" class="inline-btn" value="Save Changes" style="font-size: .9rem; padding: .5rem .6rem; font-weight:700; cursor: pointer;">
            </div>
        </form>
        <!--=============== Profile section | END ===============-->
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
