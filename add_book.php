<?php
session_start(); // Start the session to access session variables

// Database connection parameters
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "staracademydb"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variable to track if the book was added successfully
$bookAdded = false;
$errorMessage = ""; // Variable to hold error messages

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $description = $conn->real_escape_string($_POST['description']);

    // Check if the book already exists
    $checkSql = "SELECT * FROM featured_books WHERE title = '$title'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $errorMessage = "This book is already in the database."; // Set error message
    } else {
        // Handle PDF file upload
        $pdfFileName = $_FILES['pdf']['name'];
        $pdfFileTmp = $_FILES['pdf']['tmp_name'];
        $pdfFilePath = 'uploads/pdf/' . basename($pdfFileName);
        
        // Handle image file upload
        $imageFileName = $_FILES['image']['name'];
        $imageFileTmp = $_FILES['image']['tmp_name'];
        $imageFilePath = 'uploads/images/' . basename($imageFileName);

        // Create directories if they do not exist
        if (!is_dir('uploads/pdf')) {
            mkdir('uploads/pdf', 0755, true);
        }
        if (!is_dir('uploads/images')) {
            mkdir('uploads/images', 0755, true);
        }

        // Move uploaded files to the desired directory
        if (move_uploaded_file($pdfFileTmp, $pdfFilePath) && move_uploaded_file($imageFileTmp, $imageFilePath)) {
            // SQL query to insert the book
            $sql = "INSERT INTO featured_books (title, author, description, pdf_file, image_file) VALUES ('$title', '$author', '$description', '$pdfFilePath', '$imageFilePath')";

            // Execute the query and check for success
            if ($conn->query($sql) === TRUE) {
                $bookAdded = true; // Set the variable to true if the book was added successfully
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . $conn->error; // Set error message
            }
        } else {
            $errorMessage = "Error uploading files."; // Set error message
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Featured Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        </style>
</head>
<body>

<h1>Add Featured Book</h1>

<?php
// Display error message if there is one
if (!empty($errorMessage)) {
    echo "<div style='color: red; margin-bottom: 20px;'>$errorMessage</div>";
}

// Display success message if the book was added successfully
if ($bookAdded) {
    echo "<div style='color: green; margin-bottom: 20px;'>Book added successfully!</div>";
}
?>

<form action="add_book.php" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="author">Author:</label>
    <input type="text" id="author" name="author" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="pdf">Upload PDF:</label>
    <input type="file" id="pdf" name="pdf" accept=".pdf" required>

    <label for="image">Upload Image:</label>
    <input type="file" id="image" name="image" accept="image/*" required>

    <input type="submit" value="Add Book">
</form>

</body>
</html>