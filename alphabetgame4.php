<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alphabet Game with High score3</title>
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
        .score3board {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
        }
        .score3board p{
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
    <div class="score3board">
      <p>High score3: <span id="highscore3">0</span></p>
      
        <p>score3: <span id="score3">0</span></p>
        
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
            { word: "Ke_s", image: "https://via.placeholder.com/200?text=Keys", missingLetter: "y" },
            { word: "Ba_lpen", image: "https://via.placeholder.com/200?text=Ballpen", missingLetter: "l" },
            { word: "Gla_ses", image: "https://via.placeholder.com/200?text=Glasses", missingLetter: "s" },
            { word: "Mu_", image: "https://via.placeholder.com/200?text=Mug", missingLetter: "g" },
            { word: "P_ncil", image: "https://via.placeholder.com/200?text=Pencil", missingLetter: "e" },
            { word: "Ch_in", image: "https://via.placeholder.com/200?text=Chain", missingLetter: "a" },
            { word: "Tab_e", image: "https://via.placeholder.com/200?text=Table", missingLetter: "l" },
            { word: "Co_k", image: "https://via.placeholder.com/200?text=Cook", missingLetter: "o" },
            { word: "Cup_oard", image: "https://via.placeholder.com/200?text=Cupboard", missingLetter: "b" },
            { word: "Bo_k", image: "https://via.placeholder.com/200?text=Book", missingLetter: "o" },
            { word: "Sciss_rs", image: "https://via.placeholder.com/200?text=Scissors", missingLetter: "o" },
            { word: "P_n", image: "https://via.placeholder.com/200?text=Pan", missingLetter: "a" },
            { word: "La_p", image: "https://via.placeholder.com/200?text=Lamp", missingLetter: "m" },
            { word: "Cl_ck", image: "https://via.placeholder.com/200?text=Clock", missingLetter: "o" },
            { word: "Doo_", image: "https://via.placeholder.com/200?text=Door", missingLetter: "r" },
            { word: "P_ap", image: "https://via.placeholder.com/200?text=Paper", missingLetter: "e" },
            { word: "B_xt", image: "https://via.placeholder.com/200?text=Box", missingLetter: "o" },
            { word: "B_ttles", image: "https://via.placeholder.com/200?text=Bottles", missingLetter: "o" },
            { word: "B_asers", image: "https://via.placeholder.com/200?text=Erasers", missingLetter: "r" },
            { word: "Spe_kers", image: "https://via.placeholder.com/200?text=Speakers", missingLetter: "a" }

            
        ];

        let currentIndex = 0;
        let score3 = 0;
        let highscore3 = 0;

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
        score3++;
        document.getElementById('score3').textContent = score3;
        currentIndex++;
        if (currentIndex < gameData.length) {
            setTimeout(loadGame, 1000);
        } else {
            document.getElementById('resultMessage').textContent = "Congratulations! You've completed the game!";
        }
    } else {
        // Show pop-up when the answer is wrong
        const playAgain = confirm("Wrong! Your score3 is " + score3 + " Do you want to play again?");
        if (playAgain) {
            // Update high score3 if current score3 is greater
            if (score3 > highscore3) {
                highscore3 = score3;
                document.getElementById('highscore3').textContent = highscore3;
            }

            // Reset current score3 to 0 and restart the game
            score3 = 0;
            document.getElementById('score3').textContent = score3;
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

const sc3 = score3;
localStorage.setItem('scoring3', sc3);
    </script>
    <script src="js/script.js"></script>
</body>
</html>
