<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alphabet Game with High Score</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- Custom CSS -->
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
        .score1board {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .score1board p {
            font-size: 25px;
        }
        #wordHint {
            font-size: 30px;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
        }
        .footer {
            margin-top: 30px;
            font-size: 16px;
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
        <img src="images/pic-1.jpg" class="image" alt="">
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

<h1>Alphabet Game</h1>
<div class="score1board">
    <p>High Score: <span id="highscore1">0</span></p>
    <p>Score: <span id="score1">0</span></p>
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
        { word: "C_t", image: "https://via.placeholder.com/200?text=Cat", missingLetter: "a" },
        { word: "D_g", image: "https://via.placeholder.com/200?text=Dog", missingLetter: "o" },
        { word: "F_sh", image: "https://via.placeholder.com/200?text=Fish", missingLetter: "i" },
        { word: "B_rd", image: "https://via.placeholder.com/200?text=Bird", missingLetter: "i" },
        { word: "H_rse", image: "https://via.placeholder.com/200?text=Horse", missingLetter: "o" },
        { word: "El_phant", image: "https://via.placeholder.com/200?text=Elephant", missingLetter: "e" },
        { word: "L_on", image: "https://via.placeholder.com/200?text=Lion", missingLetter: "i" },
        { word: "Ti_er", image: "https://via.placeholder.com/200?text=Tiger", missingLetter: "g" },
        { word: "Le_pard", image: "https://via.placeholder.com/200?text=Leopard", missingLetter: "o" },
        { word: "P_nguin", image: "https://via.placeholder.com/200?text=Penguin", missingLetter: "e" },
    ];

    let currentIndex = 0;
    let score1 = 0;
    let highscore1 = 0;

    function shuffleGameData(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function loadGame() {
        if (currentIndex < gameData.length) {
            const currentGame = gameData[currentIndex];
            document.getElementById('hintImage').src = currentGame.image;
            document.getElementById('wordHint').textContent = `Word: ${currentGame.word}`;
            document.getElementById('letterInput').value = "";
            document.getElementById('resultMessage').textContent = "";
        } else {
            document.getElementById('resultMessage').textContent = "Game Over! You've completed all the questions.";
            checkAndUploadScore(); // Check and upload score at the end of the game
        }
    }

    function checkAnswer() {
        const userInput = document.getElementById('letterInput').value.toLowerCase();
        const correctLetter = gameData[currentIndex].missingLetter;

        if (userInput === correctLetter) {
            document.getElementById('resultMessage').textContent = "Correct! 🎉";
            score1++;
            document.getElementById('score1').textContent = score1;
        } else {
            document.getElementById('resultMessage').textContent = "Wrong! Skipping to the next question...";
        }

        currentIndex++; // Move to the next question whether correct or incorrect
        setTimeout(loadGame, 1000); // Delay before loading the next question
    }

    function checkAndUploadScore() {
        if (score1 > highscore1) {
            const playerName = prompt("New High Score! Enter your name to save:");
            if (playerName) {
                saveScoreToDatabase(playerName, score1, "alphabet");
                highscore1 = score1; // Update the local high score
                document.getElementById('highscore1').textContent = highscore1;
            } else {
                alert("Score not saved because no name was provided.");
            }
        } else {
            alert("You did not beat the high score. Try again!");
        }
    }

    function saveScoreToDatabase(playerName, score, game) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_score.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert("Score uploaded successfully!");
                    } else {
                        alert("Failed to upload score: " + response.message);
                    }
                } else {
                    alert("Error communicating with server.");
                }
            }
        };

        const data = `player_name=${encodeURIComponent(playerName)}&score=${score}&game=${encodeURIComponent(game)}`;
        xhr.send(data);
    }

    window.onload = function () {
        shuffleGameData(gameData);
        loadGame();
    };
</script>

</body>
</html>
