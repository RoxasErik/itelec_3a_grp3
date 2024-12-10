<?php
session_start();

// Database connection
$db = mysqli_connect('localhost', 'root', '', 'staracademydb'); // Update credentials if needed

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = $_POST['password'];

        // Query to select user from tbllogin table
        $query = "SELECT * FROM tbllogin WHERE email='$email'";
        $results = mysqli_query($db, $query);

        if ($results) {
            if (mysqli_num_rows($results) == 1) {
                $row = mysqli_fetch_assoc($results);
                // Verify the hashed password
                if (password_verify($password, $row['password'])) {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role'] = $row['role'];
                    header('location: home.php');
                    exit();
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "Email not found.";
            }
        } else {
            $error_message = "Query error: " . mysqli_error($db);
        }
    } else {
        $error_message = "Please fill in both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Login</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="style.css">

   <style>
      :root {
         --main-color: #529cff;
         --red: #e74c3c;
         --light-bg: #eee;
         --black: #2c3e50;
         --white: #fff;
      }

      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: Arial, sans-serif;
      }

      body {
         background-color: var(--light-bg);
         font-size: 16px;
      }

      .header, .footer {
         width: 100%;
         background-color: var(--white);
         color: var(--black);
         display: flex;
         justify-content: center;
         align-items: center;
         text-align: center;
         padding: 1rem 0;
         margin: 0;
         box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      }

      .header .logo img {
         max-height: 80px;
      }

      .form-container {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         min-height: calc(100vh - 160px); /* Adjusted for header and footer height */
      }

      .form-container form {
         background: var(--white);
         padding: 30px;
         border-radius: 8px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         width: 100%;
         max-width: 400px;
         text-align: center;
      }

      .form-container h3 {
         margin-bottom: 20px;
         font-size: 24px;
         color: var(--black);
      }

      .form-container p {
         text-align: left;
         margin-bottom: 10px;
         color: #555;
      }

      .form-container .box {
         width: 100%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ddd;
         border-radius: 5px;
         font-size: 14px;
      }

      .form-container .btn {
         width: 100%;
         padding: 10px;
         background-color: var(--main-color);
         color: var(--white);
         border: none;
         border-radius: 5px;
         font-size: 16px;
         cursor: pointer;
         margin-bottom: 10px;
         transition: background 0.3s;
      }

      .form-container .btn:hover {
         background-color: #0056b3;
      }

      .form-container .register-btn {
         background-color: #28a745;
      }

      .form-container .register-btn:hover {
         background-color: #218838;
      }
   </style>
</head>
<body>

<header class="header">
   <a href="home.html" class="logo">
      <img src="images/starlogo.png" alt="Star Academy Logo" />
   </a>
</header>

<section class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <?php if (!empty($error_message)): ?>
         <p style="color: red;"><?php echo $error_message; ?></p>
      <?php endif; ?>
      <p>Your Email <span>*</span></p>
      <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
      <p>Your Password <span>*</span></p>
      <input type="password" name="password" placeholder="Enter your password" required maxlength="20" class="box">
      <input type="submit" value="Login" name="submit" class="btn">
      <a href="register.php" class="btn register-btn">Register</a>
   </form>
</section>

<footer class="footer">
   <span>&copy; 2024 Star Academy</span>
</footer>

</body>
</html>
