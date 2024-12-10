<?php
session_start();

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

$lessonAdded = false;
$errorMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    
    // Handle video file upload
    $videoFileName = $_FILES['video']['name'];
    $videoFileTmp = $_FILES['video']['tmp_name'];
    $videoFilePath = 'uploads/videos/' . basename($videoFileName);

    // Create the videos directory if it doesn't exist
    if (!is_dir('uploads/videos')) {
        mkdir('uploads/videos', 0755, true);
    }

    // Move uploaded video to the desired directory
    if (move_uploaded_file($videoFileTmp, $videoFilePath)) {
        $sql = "INSERT INTO lessons (title, description, video_file) VALUES ('$title', '$description', '$videoFilePath')";
        if ($conn->query($sql) === TRUE) {
            $lessonAdded = true;
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $errorMessage = "Error uploading video file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lesson</title>
    <style>
        /* Similar styles as before */
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        form { margin-top: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="text"], textarea, input[type="file"] { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>

<h1>Add Lesson</h1>

<?php
if (!empty($errorMessage)) {
    echo "<div style='color: red;'>$errorMessage</div>";
}

if ($lessonAdded) {
    echo "<div style='color: green;'>Lesson added successfully!</div>";
}
?>

<form action="add_lesson.php" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    
    <label for="video">Upload Video:</label>
    <input type="file" id="video" name="video" accept="video/*" required>
    
    <input type="submit" value="Add Lesson">
</form>

</body>
</html>
