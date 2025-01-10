<?php
session_start();
include('db/database.php'); // Ensure this file has the correct connection details

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = ?");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the SELECT statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(50));

        // Debugging: Check if the column `reset_token` exists in the `User` table
        // You can print out the query to debug
        echo "Token generated: $token <br>";
        echo "Updating reset_token for email: $email <br>";
        
        // Check the structure of the User table to ensure reset_token column exists
        $stmt = $conn->prepare("UPDATE User SET reset_token = ? WHERE email = ?");

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Error preparing the update statement: " . $conn->error);
        }

        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Create a password reset link (replace 'yourwebsite.com' with your actual domain)
        $reset_link = "http://yourwebsite.com/resetPassword.php?token=$token";

        // For testing purposes, display the reset link on the screen
        echo "Password reset link has been sent to your email: <a href='$reset_link'>Reset Password</a>";

    } else {
        // If no user is found with the given email address
        $error = "No account found with that email address.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="forgot-password-page">
    <div class="form-container">
        <h2>Forgot Password</h2>
        <form method="POST" action="forgotPassword.php">
            <label for="email">Enter your email address:</label>
            <input type="email" name="email" id="email" required>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>
