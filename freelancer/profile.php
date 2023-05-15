<?php
    session_start();

    @include '../login/config.php';

    if (isset($_POST['submit'])) {
        
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $profession = mysqli_real_escape_string($conn, $_POST['profession']);
        $hourly_rate = mysqli_real_escape_string($conn, $_POST['hourly_rate']);
        $skills = mysqli_real_escape_string($conn, $_POST['skills']);
        $languages = mysqli_real_escape_string($conn, $_POST['languages']);
        $description_free = mysqli_real_escape_string($conn, $_POST['description_free']);
        $experiences = mysqli_real_escape_string($conn, $_POST['experiences']);  

        
        $freelancer_id = $_SESSION['freelancer_id'];

        $query = "UPDATE freelancer SET first_name_free = '$first_name', last_name_free = '$last_name', email_freelancer = '$email', profession = '$profession', hourly_rate = '$hourly_rate', skills = '$skills' , languages = '$languages' , experiences = '$experiences' WHERE id_freelancer = '$freelancer_id'";
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
                mysqli_query($conn, "UPDATE freelancer SET password_freelancer = '$repeat_new_password' WHERE id_freelancer = '$freelancer_id'") or die('query failed');
                $message[] = 'password updated successfully!';
            }
        }

        header("Location: profile.php");
        exit();
    }

    $freelancer_id = $_SESSION['freelancer_id'];
    $select = mysqli_query($conn, "SELECT * FROM freelancer WHERE id_freelancer = '$freelancer_id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
    }
    
    $query = "SELECT first_name_free, last_name_free, email_freelancer, profession, hourly_rate, skills, languages, description_free, experiences FROM freelancer WHERE id_freelancer = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $freelancer_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email, $profession, $hourly_rate, $skills, $languages, $description_free, $experiences);
    $stmt->fetch();
    $stmt->close();
?>

<?php
    $ex=$fetch['exentation'];

    if(isset( $_FILES['cr']["name"])){
        // if ($fetch['statut'] == 1) {
        //     unlink('C:\xampp\htdocs\lanc\freelancer\photofreelancer\\'.$freelancer_id.'.'.$ex);
        // }
        $fileType = $_FILES['cr']["type"];
        $fileData =  $_FILES['cr']["tmp_name"];
        $sizeData =  $_FILES['cr']["size"];
        $fileName= $_FILES['cr']["name"];
        $fileNameParts = explode('.', $fileName);
        $ext = end($fileNameParts);
        $nemnew=$freelancer_id.'.'.$ext;
        $n=1;

        if($ext=='jpg' || $ext=='jpge'  || $ext=='png'  ){
            $sql9= "UPDATE freelancer set statut='$n', exentation='$ext' where id_freelancer='$freelancer_id'";
            $result4 = mysqli_query($conn, $sql9 );
            move_uploaded_file($fileData,'C:\xampp\htdocs\lanc\freelancer\photofreelancer\\'.$nemnew);
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
        <link rel="shortcut icon" href="img/freelancelogo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="CSS/profile.css">
    </head>
    <body>
        <header class="header">
            <section class="flex">
            <a href="profile.php" class="logo">Home</a>
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
                            echo '<img class="profile-pic" src="photofreelancer/default.jpg">' ;
                        } 
                        else{
                            $ex=$fetch['exentation'];
                            $namf=$freelancer_id.'.'.$ex;
                            echo ' <img class="profile-pic" src="photofreelancer/'.$namf.'">';
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
                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                                <h5>First Name</h5>
                                <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                            </div>
                        </div>
                                
                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                            <h5>Last Name</h5>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                            </div>
                        </div>
                        
                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                                <h5>Email</h5>
                                <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" style="width: 350px;">
                            </div>
                        </div>

                    </div>
                    <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                                <select class="form-control" name="profession">
                                    <option value="" selected>Choose profession...</option>
                                    <?php
                                    $options = array(
                                        "Developer",
                                        "Designer",
                                        "Programmer",
                                        "Translator",
                                        "Data Scientist",
                                        "Project Manager",
                                        "Marketing Specialist",
                                        "Video Editor",
                                        "UI/UX Designer",
                                        "Game Developer",
                                        "Photographer",
                                        "Copywriter",
                                        "Voiceover Artist",
                                        "Content Creator",
                                        "Other"
                                    );
                                foreach ($options as $option) {
                                    $selected = ($option == $row['profession']) ? 'selected' : '';
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
        </section>


        <section>
            <div class="headline">
                <h3><i class="fa-regular fa-circle-user"></i> Other infos</h3>
            </div>

            <div class="section-wrapper" style="margin-bottom: 50px;">
                <div class="infos">
                    <div class="fields" style="grid-template-columns: repeat(2, 1fr); display: grid;">
                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                                <h5>Skills</h5>
                                <input type="text" name="skills" value="<?php echo htmlspecialchars($skills); ?>">
                            </div>
                        </div>
                                
                        
                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                                <h5>languages</h5>
                                <input type="text" name="languages" value="<?php echo htmlspecialchars($languages); ?>">
                            </div>
                        </div>

                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                            <h5>experiences</h5>
                            <input type="text" name="experiences" value="<?php echo htmlspecialchars($experiences); ?>">
                            </div>
                        </div>
                        
                        <div class="field-submit" style="margin-right: 15px;">
                            <div class="card">
                                <h5>hourly_rate</h5>
                                <input type="text" name="hourly_rate" value="<?php echo htmlspecialchars($hourly_rate); ?>" style="width: 350px;">
                            </div>
                        </div>

                        <div class="field-submit" style="margin-right: 15px;">
                            <h5 for="description_free">Description</h5>
                            <textarea name="description_free" cols="70" rows="10" id="description_free" ><?php echo htmlspecialchars($description_free); ?></textarea>
                            <!-- <input type="text" name="description_free" value="<?php echo htmlspecialchars($description_free); ?>"> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        
        <section style="padding-top: 0;">
            <div class="headline" style="margin-bottom: -30px;">
                <h3><i class="fa-solid fa-lock"></i> Password & Security</h3>
            </div>

            <div class="section-wrapper" >
                <div class="infos">
                    <div class="fields">
                        <input type="hidden" name="old_pass" value="<?php echo $fetch['password_freelancer']; ?>">
                        <br>
                        <div class="card" style="width: 100%; margin-top: 20px;">
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
            </div>
        </section>
        <div class="btn-container">
            <input name="submit" type="submit" class="inline-btn" value="Save Changes">
        </div>
    </form>

        <footer class="footer">
            <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
        </footer>

        <!--=============== Custom js file link ===============-->
        <script src="JS/script2.js"></script>

    </body>
</html>