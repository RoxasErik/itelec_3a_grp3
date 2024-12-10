<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "staracademydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all lessons from the database
$sql = "SELECT id, title, description, video_file FROM lessons";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lessons - Star Academy</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->

    <style>
        .lessons-container {
            padding: 20px;
        }

        .lessons-list {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .lesson-item {
            flex: 1 1 calc(25% - 30px);
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .lesson-item h3 {
            font-size: 1.5rem;
            margin: 15px 0;
        }

        .lesson-item p {
            font-size: 1rem;
            margin: 8px 0;
        }

        .lesson-item video {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .btn {
            display: inline-block;
            margin-top: 12px;
            padding: 12px 18px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn.delete-btn {
            background-color: #dc3545;
        }

        .btn.add-btn {
            background-color: #28a745;
            margin-top: 20px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .add-lesson-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<header class="header">
    <section class="flex">
        <a href="home.php" class="logo">
            <img src="images/starlogo.png" alt="Star Academy Logo">
        </a>

        <form action="search.html" method="post" class="search-form">
            <input type="text" name="search_box" required placeholder="Search lessons..." maxlength="100">
            <button type="submit" class="fas fa-search"></button>
        </form>

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

<section class="lessons-container">
    <h1 class="heading">Uploaded Lessons</h1>
    <div class="lessons-list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='lesson-item'>
                    <h3>" . htmlspecialchars($row['title']) . "</h3>
                    <p>" . htmlspecialchars($row['description']) . "</p>
                    <video controls>
                        <source src='" . htmlspecialchars($row['video_file']) . "' type='video/mp4'>
                        Your browser does not support the video tag.
                    </video>
                    <a class='btn delete-btn' href='delete_lesson.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Are you sure you want to delete this lesson?\");'>Delete</a>
                </div>";
            }
        } else {
            echo "<p>No lessons found.</p>";
        }
        ?>
    </div>
    
    <!-- Add Lesson Button -->
    <div class="add-lesson-container">
        <a class="btn add-btn" href="add_lesson.php">Add New Lesson</a>
    </div>
</section>

<footer class="footer">
    <span>Star Academy</span>
</footer>

</body>
</html>
