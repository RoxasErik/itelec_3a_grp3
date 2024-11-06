<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$db = mysqli_connect('localhost', 'root', '', 'staracademydb'); // Check your credentials

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the expected POST variables are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = $_POST['password'];

        // Query to select user from tbllogin table
        $query = "SELECT * FROM tbllogin WHERE email='$email'";
        $results = mysqli_query($db, $query);

        // Check if query was successful
        if ($results) {
            if (mysqli_num_rows($results) == 1) {
                $row = mysqli_fetch_assoc($results);
                // Directly compare the plain text password
                if ($password === $row['password']) {
                    $_SESSION['email'] = $email;
                    header('location: home.html');
                    exit();
                } else {
                    $error_message = "Wrong Password"; // Set error message for wrong password
                }
            } else {
                $error_message = "Wrong Email"; // Set error message for wrong email
            }
        } else {
            $error_message = "Query Error: " . mysqli_error($db);
        }
    } else {
        $error_message = "Please fill in both Email and Password."; // Set error message for empty fields
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="header">
   <section class="flex">
       <a href="home.html" class="logo">
           <img src="images/starlogo.png" alt="Logo"/>
       </a>

      <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <img src="images/pic-1.jpg" class="image" alt="">
         <h3 class="name">John</h3>
         <p class="role">Parent</p>
         <a href="profile.html" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login.html" class="option-btn">login</a>
            <a href="register.html" class="option-btn">register</a>
         </div>
      </div>
   </section>
</header>   

<div class="side-bar">
   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="">
      <h3 class="name">John</h3>
      <p class="role">Parent</p>
      <a href="profile.html" class="btn">view profile</a>
   </div>

   <nav class="navbar">
      <a href="home.html"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="lessons.html"><i class="fas fa-graduation-cap"></i><span>Lessons</span></a>
      <a href="books.html"><i class="fas fa-chalkboard-user"></i><span>Library</span></a>
      <a href="games.html"><i class="fas fa-headset"></i><span>Games</span></a>
      <a href="about.html"><i class="fas fa-question"></i><span>About Us</span></a>
   </nav>
</div>

<section class="form-container">
   <form id="loginForm" action="" method="post" enctype="multipart/form-data">
      <h3>Login Now</h3>
      <p>Your Email <span>*</span></p>
      <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
      <p>Your Password <span>*</span></p>
      <input type="password" name="password" placeholder="Enter your password" required maxlength="20" class="box"> <!-- Changed 'pass' to 'password' -->
      <input type="submit" value="Login" name="submit" class="btn">
      <p id="errorMessage" style="color:red;"><?php if (!empty($error_message)) echo $error_message; ?></p> <!-- Display error message -->
   </form>
</section>

<footer class="footer">
  <span>Star Academy</span> 
</footer>



</body>
</html>