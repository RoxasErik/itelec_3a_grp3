<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="style.css">
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

<section class="home-grid">
   <h1 class="heading">Featured Books</h1>
   <div class="box-container">
      <div class="box">
         <h3 class="title">What is it?</h3>
         <div class="flex">
            <img src="images/Book-1.png" alt="" style="width: 100%; height: 100%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
      </div>
      <div class="box">
         <h3 class="title">Drip-Drop-Drip</h3>
         <div class="flex">
            <img src="images/Book-2.png" alt="" style="width: 100%; height: 100%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
      </div>
      <div class="box">
         <h3 class="title">Ma! Hurry Up!!</h3>
         <div class="flex">
            <img src="images/Book-3.png" alt="" style="width: 100%; height: 100%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
      </div>
   </div>
   <div class="more-btn">
      <a href="view_books.php" class="inline-option-btn">Let's Start Reading</a>
   </div>
</section>

<section class="courses">
   <h1 class="heading">Lessons</h1>
   <div class="box-container">
      <div class="box">
         <div class="tutor">
            <div class="info">
               <h3>Numbers</h3>
            </div>
         </div>
         <div class="thumb">
            <img src="images/7.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
         
      </div>
      <div class="box">
         <div class="tutor">
            <div class="info">
               <h3>Alphabet</h3>
            </div>
         </div>
         <div class="thumb">
            <img src="images/4.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
      
      </div>
      <div class="box">
         <div class="tutor">
            <div class="info">
               <h3>Colors</h3>
            </div>
         </div>
         <div class="thumb">
            <img src="images/5.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>

      </div>
   </div>
   <div class="more-btn">
      <a href="view_lessons.php" class="inline-option-btn">Let's Learn More</a>
   </div>
</section>

<footer class="footer">
   <span>Star Academy</span>
</footer>

<script>
   function toggleForm(formId) {
      const form = document.getElementById(formId);
      form.style.display = (form.style.display === 'block') ? 'none' : 'block';
   }
</script>

</body>
</html>
