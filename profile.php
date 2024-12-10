<?php
session_start(); // Start session

// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "staracademydb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch the player's name and high scores for all games
$sql = "SELECT player_name, game, MAX(percentage) AS highest_percentage 
        FROM scores 
        GROUP BY player_name, game";
$result = $conn->query($sql);

// Initialize scores array
$player_scores = [];

// Populate scores array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $player_scores[$row['player_name']][$row['game']] = $row['highest_percentage'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <link rel="stylesheet" href="style.css">
   <style>
       body {
           font-family: Arial, sans-serif;
           background-color: #f8f9fa;
           margin: 0;
           padding: 0;
       }
       header {
           background-color: #007bff;
           color: white;
           text-align: center;
           padding: 1rem 0;
       }
       .user-profile {
           max-width: 1200px;
           margin: 20px auto;
           padding: 20px;
           background-color: white;
           border-radius: 8px;
           box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
       }
       .player-section {
           margin-bottom: 30px;
           border-bottom: 1px solid #ddd;
           padding-bottom: 20px;
       }
       .player-section:last-child {
           border-bottom: none;
       }
       .player-section h2 {
           color: #007bff;
       }
       .card-grid {
           display: flex;
           flex-wrap: wrap;
           gap: 20px;
           justify-content: center;
       }
       .card {
           text-align: center;
           width: 200px;
           background-color: #f9f9f9;
           border: 1px solid #ddd;
           border-radius: 8px;
           box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
           padding: 20px;
       }
       .card img {
           width: 80px;
           height: 80px;
           margin: 0 auto;
           display: block;
       }
       .progress-container {
           background-color: #e9ecef;
           border-radius: 8px;
           height: 20px;
           width: 100%;
           margin: 10px 0;
       }
       .progress-bar {
           height: 100%;
           border-radius: 8px;
           background-color: #4caf50;
           text-align: center;
           color: white;
           line-height: 20px;
           width: 0;
           transition: width 0.5s ease;
       }
   </style>
</head>
<body>

<header class="header">
   <section class="flex">
      <a href="home.php" class="logo">
         <img src="images/starlogo.png" alt="Star Academy Logo">
      </a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
         <img src="images/pic-1.jpg" class="image" alt="User Profile">
         <h3 class="name">John</h3>
         <p class="role">Parent</p>
         <a href="profile.php" class="btn">View Profile</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">Login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div>
      </div>
   </section>
</header>

<div class="side-bar">
   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="User Profile">
      <h3 class="name">John</h3>
      <p class="role">Parent</p>
      <a href="profile.php" class="btn">View Profile</a>
   </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="view_lessons.php"><i class="fas fa-graduation-cap"></i><span>Lessons</span></a>
      <a href="view_books.php"><i class="fas fa-chalkboard-user"></i><span>Library</span></a>
      <a href="games.php"><i class="fas fa-headset"></i><span>Games</span></a>
      <a href="about.html"><i class="fas fa-question"></i><span>About Us</span></a>
   </nav>
</div>



<section class="user-profile">
   <?php foreach ($player_scores as $player_name => $scores): ?>
       <div class="player-section">
           <h2><?= htmlspecialchars($player_name) ?>'s Progress</h2>
           <div class="card-grid">
               <!-- Alphabet Grade -->
               <div class="card">
                   <img src="images/7.png" alt="Alphabet">
                   <h4>Alphabet Grade</h4>
                   <p>Progress: <?= $scores['alphabet'] ?? 0 ?>%</p>
                   <div class="progress-container">
                       <div class="progress-bar" style="width: <?= $scores['alphabet'] ?? 0 ?>%;"></div>
                   </div>
               </div>
               <!-- Number Grade -->
               <div class="card">
                   <img src="images/4.png" alt="Number">
                   <h4>Number Grade</h4>
                   <p>Progress: <?= $scores['number'] ?? 0 ?>%</p>
                   <div class="progress-containers">
                       <div class="progress-bar" style="width: <?= $scores['number'] ?? 0 ?>%;"></div>
                   </div>
               </div>
               <!-- Color Grade -->
               <div class="card">
                   <img src="images/5.png" alt="Color">
                   <h4>Color Grade</h4>
                   <p>Progress: <?= $scores['color'] ?? 0 ?>%</p>
                   <div class="progress-container">
                       <div class="progress-bar" style="width: <?= $scores['color'] ?? 0 ?>%;"></div>
                   </div>
               </div>
               <!-- Shape Grade -->
               <div class="card">
                   <img src="images/6.png" alt="Shape">
                   <h4>Shape Grade</h4>
                   <p>Progress: <?= $scores['shape'] ?? 0 ?>%</p>
                   <div class="progress-container">
                       <div class="progress-bar" style="width: <?= $scores['shape'] ?? 0 ?>%;"></div>
                   </div>
               </div>
           </div>
       </div>
   <?php endforeach; ?>
</section>

<footer class="footer">

   <span>Star Academy</span> 

</footer>
<script src="js/script.js"></script>

</body>
</html>
