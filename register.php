<?php
session_start();

// Database connection
$db = mysqli_connect('localhost', 'root', '', 'staracademydb'); // Update credentials if needed

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = ""; // To store error messages
$success_message = ""; // To store success messages

// Function to register a new user
function registerUser($name, $email, $password, $c_password, $profile_image, $db) {
    // Check if passwords match
    if ($password !== $c_password) {
        return "Passwords do not match.";
    }

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM tbllogin WHERE email = '$email'";
    $result = mysqli_query($db, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        return "Email already exists.";
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile image upload
    $profileImagePath = "";
    if ($profile_image['error'] == UPLOAD_ERR_OK) {
        $imageName = $profile_image['name'];
        $imageTmpName = $profile_image['tmp_name'];
        $profileImagePath = 'uploads/profile_images/' . basename($imageName);

        // Create directory if it doesn't exist
        if (!is_dir('uploads/profile_images')) {
            mkdir('uploads/profile_images', 0755, true);
        }

        // Move uploaded file
        if (!move_uploaded_file($imageTmpName, $profileImagePath)) {
            return "Failed to upload profile image.";
        }
    }

    // Insert user data into the database
    $insertQuery = "INSERT INTO tbllogin (name, email, password, profile_image, role) 
                    VALUES ('$name', '$email', '$hashedPassword', '$profileImagePath', 'Parent')";

    if (mysqli_query($db, $insertQuery)) {
        return "success"; // Registration successful
    } else {
        return "Error: " . mysqli_error($db);
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['pass'];
    $c_password = $_POST['c_pass'];
    $profile_image = $_FILES['profile_image'];

    $registrationStatus = registerUser($name, $email, $password, $c_password, $profile_image, $db);

    if ($registrationStatus === "success") {
        $success_message = "Registration successful! You can now log in.";
    } else {
        $error_message = $registrationStatus;
    }
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Register Now</h3>
      <?php if (!empty($error_message)): ?>
         <p style="color: red;"><?php echo $error_message; ?></p>
      <?php endif; ?>
      <?php if (!empty($success_message)): ?>
         <p style="color: green;"><?php echo $success_message; ?></p>
      <?php endif; ?>
      <p>Your Name <span>*</span></p>
      <input type="text" name="name" placeholder="Enter your name" required maxlength="50" class="box">
      <p>Your Email <span>*</span></p>
      <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
      <p>Your Password <span>*</span></p>
      <input type="password" name="pass" placeholder="Enter your password" required maxlength="20" class="box">
      <p>Confirm Password <span>*</span></p>
      <input type="password" name="c_pass" placeholder="Confirm your password" required maxlength="20" class="box">
      <p>Select Profile Image <span>*</span></p>
      <input type="file" name="profile_image" accept="image/*" required class="box">
      <input type="submit" value="Register" name="submit" class="btn">
   </form>
</section>

</body>
</html>
