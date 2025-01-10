<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Breathing Session</title>
    <script>
        function redirectToLogin() {
            let timeLeft = 30; 
            const countdownElement = document.getElementById('countdown');

            const countdown = setInterval(function() {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    window.location.href = 'login.php'; 
                } else {
                    countdownElement.textContent = timeLeft + ' seconds remaining';
                    timeLeft -= 1;
                }
            }, 1000); 
        }
    </script>

</head>
<body onload="redirectToLogin()" class="breathing-page">
    <div class="breathing-container">
        <h2>Please relax and breathe deeply for 30 seconds</h2>
        <p id="countdown">30 seconds remaining</p> 
        <p>You will be redirected to the login page shortly...</p>
    </div>
</body>
</html>
