<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['therapy'] == 'yes') {
        header('Location: breathing.php');
    } else {
        header('Location: login.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Therapy Session</title>
</head>
<body class="therapy-page">
    <div class="form-container">
        <h2>Would you like to participate in a therapy session?</h2>
        <form method="POST" action="therepy.php">
            <button type="submit" name="therapy" value="yes">Yes</button>
            <button type="submit" name="therapy" value="no">Skip</button>
        </form>
    </div>
    
</body>
</html>
