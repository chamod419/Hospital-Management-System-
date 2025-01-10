<?php
session_start();
include('db/database.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Initialize variables
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current user data
    $stmt = $conn->prepare("SELECT password FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if the current password is correct
    if ($user && password_verify($current_password, $user['password'])) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_stmt = $conn->prepare("UPDATE User SET password = ? WHERE username = ?");
            $update_stmt->bind_param("ss", $hashed_password, $username);

            if ($update_stmt->execute()) {
                $success = "Password updated successfully.";
            } else {
                $error = "Error updating password. Please try again.";
            }
            $update_stmt->close();
        } else {
            $error = "New password and confirm password do not match.";
        }
    } else {
        $error = "Current password is incorrect.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Reset Password</h2>
        <form method="POST" action="resetPassword.php">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if ($success): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <button type="submit">Reset Password</button>
        </form>

        <p><a href="profile.php">Back to Profile</a></p>
    </div>
</body>
</html>
