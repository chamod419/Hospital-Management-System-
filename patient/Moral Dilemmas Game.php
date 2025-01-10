<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moral Dilemmas Game</title>
    <link rel="stylesheet" href="style/moral.css">
</head>
<body>
    <div class="container">
        <h1>Moral Dilemmas</h1>
        <p>Make decisions in challenging moral scenarios. Choose what you think is right, and reflect on the consequences of your actions.</p>
        
        <div id="dilemma-container">
            <h2 id="dilemma-title">Dilemma 1: The Train Tracks</h2>
            <p id="dilemma-description">
                You see a runaway train approaching five people tied to a track. You are standing next to a lever that can divert the train to another track, but it will kill one person on that track. Do you pull the lever?
            </p>
            <div class="choices">
                <button class="btn" onclick="makeChoice('divert')">Divert the Train (Kill 1 to save 5)</button>
                <button class="btn" onclick="makeChoice('doNothing')">Do Nothing (Let 5 die)</button>
            </div>
        </div>

        <div id="feedback-container" style="display:none;">
            <h2>Decision Made</h2>
            <p id="feedback-text"></p>
            <button class="btn" onclick="nextDilemma()">Next Dilemma</button>
        </div>
    </div>

    <script src="js/moral.js"></script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moral Dilemmas Game</title>
    <link rel="stylesheet" href="style/moral.css">
</head>
<body>
    <div class="container">
        <h1>Moral Dilemmas</h1>
        <p>Make decisions in challenging moral scenarios. Choose what you think is right, and reflect on the consequences of your actions.</p>
        
        <div id="dilemma-container">
            <h2 id="dilemma-title">Dilemma 1: The Train Tracks</h2>
            <p id="dilemma-description">
                You see a runaway train approaching five people tied to a track. You are standing next to a lever that can divert the train to another track, but it will kill one person on that track. Do you pull the lever?
            </p>
            <div class="choices">
                <button class="btn" onclick="makeChoice('divert')">Divert the Train (Kill 1 to save 5)</button>
                <button class="btn" onclick="makeChoice('doNothing')">Do Nothing (Let 5 die)</button>
            </div>
        </div>

        <div id="feedback-container" style="display:none;">
            <h2>Decision Made</h2>
            <p id="feedback-text"></p>
            <button class="btn" onclick="nextDilemma()">Next Dilemma</button>
        </div>
    </div>

    <script src="js/moral.js"></script>
</body>
</html>
