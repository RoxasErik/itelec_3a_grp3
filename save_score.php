<?php
session_start(); // Start session to access user data

// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "staracademydb"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}

// Ensure the user is logged in
if (!isset($_SESSION['name'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit;
}

// Retrieve data from session and POST request
$player_name = $_SESSION['name']; // Use logged-in user's name
$score = isset($_POST['score']) ? intval($_POST['score']) : null;
$game = $_POST['game'] ?? null; // Identify the game type

// Maximum score for the game (adjust as needed)
$max_score = 10;

// Validate input
if ($score === null || $score < 0 || empty($game)) {
    echo json_encode(["success" => false, "message" => "Invalid input data."]);
    exit;
}

// Calculate percentage
$percentage = ($score / $max_score) * 100;

// Check if the player and game combination already exists
$stmt = $conn->prepare("SELECT score FROM scores WHERE player_name = ? AND game = ?");
$stmt->bind_param("ss", $player_name, $game);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Player and game exists, check if the new score is higher
    $row = $result->fetch_assoc();
    if ($score > $row['score']) {
        // Update the score and percentage with the new high score
        $update_stmt = $conn->prepare("UPDATE scores SET score = ?, percentage = ? WHERE player_name = ? AND game = ?");
        $update_stmt->bind_param("idss", $score, $percentage, $player_name, $game);
        if ($update_stmt->execute()) {
            echo json_encode(["success" => true, "message" => "High score updated successfully for game: $game."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update high score: " . $update_stmt->error]);
        }
        $update_stmt->close();
    } else {
        // New score is not higher, no update
        echo json_encode(["success" => false, "message" => "Score not updated because it is not higher than the current high score for game: $game."]);
    }
} else {
    // Player and game combination does not exist, insert a new record
    $insert_stmt = $conn->prepare("INSERT INTO scores (player_name, game, score, percentage) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("ssid", $player_name, $game, $score, $percentage);
    if ($insert_stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Score saved successfully for game: $game."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save score: " . $insert_stmt->error]);
    }
    $insert_stmt->close();
}

$stmt->close();
$conn->close();
?>
