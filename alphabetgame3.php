<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alphabet Game with High score2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
 
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: white;
            color: black;
        }
        .game-container {
            margin-top: 25px;
        }
        .image {
            width: 200px;
            height: auto;
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        input {
            font-size: 16px;
            padding: 10px;
            width: 50px;
            text-align: center;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }
        .score2board {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
        }
        .score2board p{
            font-size: 25px;
        }
        #wordHint{
         font-size: 30px;
        }
    </style>
</head>
<body>

   <header class="header">
   
      <section class="flex">
        
   
           <a href="home.php" class="logo">
       <img src="images/starlogo.png">
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
            <a href="profile.html" class="btn">view profile</a>
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
          <a href="about.html"><i class="fas fa-question"></i><span>About Us</span></a>
      </nav>
   
   </div>
    <h1>Alphabet Game</h1>
    <div class="score2board">
      <p>High score2: <span id="highscore2">0</span></p>
      
        <p>score2: <span id="score2">0</span></p>
        
    </div>
    <div class="game-container">
        <p>Guess the missing letter!</p>
        <img id="hintImage" src="" alt="Hint Image">
        <p id="wordHint"></p>
        <input type="text" id="letterInput" maxlength="1">
        <button onclick="checkAnswer()">Submit</button>
        <div class="result" id="resultMessage"></div>
    </div>
    <div class="footer">
      <span>Star Academy</span>
  </div>
  

    <script>
        const gameData = [
            { word: "C_air", image: "https://via.placeholder.com/200?text=Chair", missingLetter: "h" },
            { word: "Ta_le", image: "https://via.placeholder.com/200?text=Table", missingLetter: "b" },
            { word: "D_sk", image: "https://via.placeholder.com/200?text=Desk", missingLetter: "e" },
            { word: "Sof_", image: "https://via.placeholder.com/200?text=Sofa", missingLetter: "a" },
            { word: "Ot_man", image: "https://via.placeholder.com/200?text=Otoman", missingLetter: "o" },
            { word: "C_air", image: "https://via.placeholder.com/200?text=Chair", missingLetter: "h" },
     // New furniture words
    { word: "C_upboard", image: "https://via.placeholder.com/200?text=Cupboard", missingLetter: "u" },
    { word: "Be_", image: "https://via.placeholder.com/200?text=Bed", missingLetter: "d" },
    { word: "War_rope", image: "https://via.placeholder.com/200?text=Wardrobe", missingLetter: "d" },
    { word: "B_nch", image: "https://via.placeholder.com/200?text=Bench", missingLetter: "e" },
    { word: "Sh_lv_s", image: "https://via.placeholder.com/200?text=Shelves", missingLetter: "e" },
    { word: "Cab_net", image: "https://via.placeholder.com/200?text=Cabinet", missingLetter: "i" },
    { word: "C_ouch", image: "https://via.placeholder.com/200?text=Couch", missingLetter: "o" },
    { word: "Recl_ner", image: "https://via.placeholder.com/200?text=Recliner", missingLetter: "i" },
    { word: "B_ffee", image: "https://via.placeholder.com/200?text=Buffet", missingLetter: "u" },
    { word: "D_esser", image: "https://via.placeholder.com/200?text=Dresser", missingLetter: "r" },
    { word: "Va_ity", image: "https://via.placeholder.com/200?text=Vanity", missingLetter: "n" },
    { word: "B_ookcase", image: "https://via.placeholder.com/200?text=Bookcase", missingLetter: "o" },
    { word: "Headb_ard", image: "https://via.placeholder.com/200?text=Headboard", missingLetter: "o" },
    { word: "T_rolley", image: "https://via.placeholder.com/200?text=Trolley", missingLetter: "r" }

        ];

        let currentIndex = 0;
        let score2 = 0;
        let highscore2 = 0;

        // Function to shuffle the game data array
function shuffleGameData(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

// Function to load the game
function loadGame() {
    const currentGame = gameData[currentIndex];
    document.getElementById('hintImage').src = currentGame.image;
    document.getElementById('wordHint').textContent = `Word: ${currentGame.word}`;
    document.getElementById('letterInput').value = "";
    document.getElementById('resultMessage').textContent = "";
}

// Function to check the player's answer
function checkAnswer() {
    const userInput = document.getElementById('letterInput').value.toLowerCase();
    const correctLetter = gameData[currentIndex].missingLetter;

    if (userInput === correctLetter) {
        document.getElementById('resultMessage').textContent = "Correct! 🎉";
        score2++;
        document.getElementById('score2').textContent = score2;
        currentIndex++;
        if (currentIndex < gameData.length) {
            setTimeout(loadGame, 1000);
        } else {
            document.getElementById('resultMessage').textContent = "Congratulations! You've completed the game!";
        }
    } else {
        // Show pop-up when the answer is wrong
        const playAgain = confirm("Wrong! Your score2 is " + score2 + " Do you want to play again?");
        if (playAgain) {
            // Update high score2 if current score2 is greater
            if (score2 > highscore2) {
                highscore2 = score2;
                document.getElementById('highscore2').textContent = highscore2;
            }

            // Reset current score2 to 0 and restart the game
            score2 = 0;
            document.getElementById('score2').textContent = score2;
            currentIndex = 0;
            shuffleGameData(gameData); // Re-shuffle the game data
            loadGame(); // Restart the game
        } else {
            // Exit the game - Show Game Over message
            document.getElementById('resultMessage').textContent = "Game Over. Thanks for playing!";
            window.location.href = "games.html"; // Replace with your target HTML file
        }
    }
}

// Initialize game on page load
window.onload = function () {
    shuffleGameData(gameData); // Shuffle the game data
    loadGame(); // Load the first game
};

const sc2 = score2;
localStorage.setItem('scoring2', sc2);
    </script>
    <script src="js/script.js"></script>
</body>
</html>
