<?php

   $conn = new mysqli('localhost','root','','lancer');

   session_start();

   $id_client = $_SESSION['client_id'];

   $sql="SELECT * FROM client WHERE id_client = '$id_client'  ";
   $req = mysqli_query($conn , $sql) ;
   $num_ligne = mysqli_fetch_assoc($req) ;

   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $type = mysqli_real_escape_string($conn, $_POST['type']);
      $category = mysqli_real_escape_string($conn, $_POST['category']);
      $budget = mysqli_real_escape_string($conn, $_POST['budget']);
      $description = mysqli_real_escape_string($conn, $_POST['description']);
      $time = mysqli_real_escape_string($conn, $_POST['time']);

      $sql = "INSERT INTO jobs (title, type, category, budget, description, time,  id_client) VALUES ('$title', '$type', '$category', '$budget', '$description', '$time', '$id_client')";
      if(mysqli_query($conn, $sql)){
         
      } else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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
   <title>Post a Job</title>

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
         <a href="post-a-job.php" class="logo">Post a Job</a>

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


   <!--=============== Post a Job section STARTS ===============-->
   <section>
      <div class="headline">
         <h3><i class="fas fa-regular fa-table-list"></i> Job Submission Form</h3>
      </div>

      <form action="post-a-job.php" method="POST" enctype="multipart/form-data">
         <div class="form-container">
            <div class="form-control">
               <label class="subm" for="job-title">Job Title</label>
               <input required class="ip"
                        id="job-title"
                        name="title"
                        placeholder="Enter job title...">
            </div>
            
            <div class="form-control">
               <label class="subm" for="job-type">Job Type</label>
               <select required class="sl" name="type" id="job-type">
                  <option value="">Select job type...</option>
                     <option value="Hourly project">Hourly project</option>
                     <option value="Full-Time">Full-Time</option>
                     <option value="Part-Time">Part-Time</option>
                     <option value="Fixed-Price">Fixed-Price</option>
                     <option value="Contract">Contract</option>
                     <option value="Flexible">Flexible </option>
                     <option value="Other">Other</option>
               </select>
            </div>
            
            <div class="form-control">
               <label class="subm" for="job-category">Job Category</label>
               <select required class="sl" name="category" id="job-category">
                  <option value="">Select job category...</option>
                     <option value="Web Development">Web Development</option>
                     <option value="Mobile Development">Mobile Development</option>
                     <option value="Sales & Marketing">Sales & Marketing</option>
                     <option value="Graphic Design">Graphic Design</option>
                     <option value="Writing">Writing</option>
                     <option value="Data Entry">Data Entry</option>
                     <option value="Accounting & Consulting">Accounting & Consulting</option>
                     <option value="Admin Support">Admin Support</option>
                     <option value="IT & Networking">IT & Networking</option>
                     <option value="Customer Service">Customer Service</option>
                     <option value="Translation">Translation</option>
                     <option value="Engineering & Architecture">Engineering & Architecture</option>
                     <option value="Social Media Management">Social Media Management</option>
                     <option value="Video & Animation">Video & Animation</option>
                     <option value="Music & Audio">Music & Audio</option>
                     <option value="Legal">Legal</option>
                     <option value="Other">Other</option>
               </select>
            </div>

            <div class="form-control">
               <label class="subm" for="budget">Budget ($)</label>
               <input required class="ip"
                        type="number"
                        id="budget"
                        name="budget"
                        min="0"
                        step="1">
            </div>

            <div class="textarea-control">
               <label class="subm" for="job-description">Job Description</label>
               <textarea required class="ta"
                        name="description"
                        id="job-description" 
                        cols="50" 
                        rows="10"
                        placeholder="Enter job description...">
               </textarea>
            </div>

            <div class="form-control">
               <label class="subm" for="job-delivery-time">Delivery Time (days)</label>
               <input required class="ip"
                     type="number"
                     id="job-delivery-time"
                     name="time"
                     min="1"
                     step="1">
            </div>
         </div>
         <div class="button-cont">
            <button class="bt" type="submit">Add Job</button>
         </div>
      </form>
   </section>
   <!--=============== Post a Job section ENDS ===============-->


   <!--=============== Footer section STARTS ===============-->
   <footer class="footer">
      <p>&#169; Copyright <span>lancer</span>. All rights reserved</p>
   </footer>
   <!--=============== Footer section ENDS ===============-->


   <!--=============== Custom js file link ===============-->
   <script src="JS/script.js"></script>

</body>
</html>