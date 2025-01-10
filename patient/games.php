<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 20px;
    }

    .container {
        text-align: center;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 1200px;
        margin: 0 auto;
    }

    h1 {
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
    }

    p {
        color: #666;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .card {
        background-color: #969494;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card p {
        font-size: 16px;
        color: #555;
    }

    a.btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 18px;
        color: white;
        background-color: #030f1d;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }

    a.btn:hover {
        background-color: #0e2b49;
    }
</style>

<body>
    <div class="container">
        <h1>Welcome to Games's page</h1>
        <p>Improve your mental sharpness, reaction time, and focus with our selection of games below.</p>
        <div class="card-container">
            <?php
            $games = [
                ["Memory Matching Game", "memory index.php", "Test your memory skills by finding matching pairs."],
                ["Cognitive Biases Quiz Game", "game index.php", "Challenge your understanding of cognitive biases."],
                ["Reaction Time Test Game", "reaction index.php", "See how fast you can react to stimuli."],
                ["Reaction Shape Time Test Game", "reaction 2 index.php", "React to shapes appearing randomly on the screen."],
                ["Word Scramble Game 1", "word 1 index.php", "Unscramble the letters to find the correct word."],
                ["Word Scramble Game 2", "word index.php", "Another fun word scramble challenge to boost your vocabulary."],
                ["Rock Paper Scissors", "rock index.php", "Play the classic game of strategy and chance."],
                ["Mind Calm Game", "mind-calm.php", "Relax and calm your mind with simple exercises."],
                ["Color Meditation", "color-meditation.php", "Focus on color transitions to meditate and reduce stress."],
                ["Moral Dilemmas Game", "Moral Dilemmas Game.php", "Challenge your ethical decision-making with moral dilemmas."]
            ];

            foreach ($games as $game) {
                echo "<div class='card'>";
                echo "<a href='" . $game[1] . "' class='btn'>" . $game[0] . "</a>";
                echo "<p>" . $game[2] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>