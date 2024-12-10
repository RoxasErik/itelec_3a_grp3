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

// Check if the book ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get the book ID from the GET request
    $id = intval($_GET['id']); // Convert to integer for safety

    // Prepare the delete query
    $query = "DELETE FROM featured_books WHERE id = ?";
    
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id); // Bind the ID parameter
        $stmt->execute(); // Execute the statement

        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            // Redirect to view_books.php after successful deletion
            header("Location: view_books.php?message=Book deleted successfully");
            exit();
        } else {
            // Log the error for debugging
            error_log("Error: Book with ID $id not found or could not be deleted.");
            echo "Error: Book not found or could not be deleted.";
        }

        $stmt->close(); // Close the statement
    } else {
        // Log the error for debugging
        error_log("Error preparing statement: " . $conn->error);
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Log the error for debugging
    error_log("Invalid request. Book ID is required.");
    echo "Invalid request. Book ID is required.";
}

// Close connection
$conn->close();
?>