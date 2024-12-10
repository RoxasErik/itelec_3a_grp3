<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>games</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<header class="header">
   
   <section class="flex">

        <a href="home.php" class="logo">
    <img src="images/starlogo.png"/>
</a>


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
         <a href="profile.php" class="btn">view profile</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
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
      <a href="profile.php" class="btn">view profile</a>
   </div>

   <nav class="navbar">
  <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="view_lessons.php"><i class="fas fa-graduation-cap"></i><span>Lessons</span></a>
      <a href="view_books.php"><i class="fas fa-chalkboard-user"></i><span>Library</span></a>
      <a href="games.php"><i class="fas fa-headset"></i><span>Games</span></a>
       <a href="about.php"><i class="fas fa-question"></i><span>About Us</span></a>
   </nav>

</div>

<section>
    </section>





<section class="courses">

   <h1 class="heading">Games</h1>

   <div class="box-container">

      <div class="box">
         <div class="tutor">
            <div class="info">
             
               
            </div>
         </div>
         <div class="thumb">
            <img src="images/4.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
         <h3 class="title">Alphabet Game</h3>
         <a href="alphabetgame.php" class="inline-btn">Play Game!</a>
      </div>

      <div class="box">
         <div class="tutor">
            <div class="info">
              
               
            </div>
         </div>
         <div class="thumb">
            <img src="images/7.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
         <h3 class="title">Number Game</h3>
         <a href="alphabetgame2.php" class="inline-btn">Play Game!</a>
      </div>

      <div class="box">
         <div class="tutor">
            <div class="info">
             
               
            </div>
         </div>
         <div class="thumb">
            <img src="images/5.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
         <h3 class="title">Colors Game</h3>
         <a href="alphabetgame3.php" class="inline-btn">Play Game!</a>
      </div>

      <div class="box">
         <div class="tutor">
            <div class="info">
              
               
            </div>
         </div>
         <div class="thumb">
            <img src="images/6.png" alt="" style="width: 100%; height: 50%; object-fit: cover; margin: 0 auto; display: block;">
         </div>
         <h3 class="title">Shapes Game</h3>
         <a href="alphabetgame4.php" class="inline-btn">Play Game!</a>
      </div>

     

     
   </div>

</section>

<footer class="footer">

   <span>Star Academy</span> 

</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>