<?php
session_start();
include('db/database.php'); 

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['nic'] = $_POST['nic'];
    $_SESSION['dob'] = $_POST['dob'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['role'] = $_POST['role']; 
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    // Check if passwords match
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "Error: Passwords do not match.";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO user (name, address, mobile, email, nic, dob, gender, role, username, password, created_at, reset_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NULL)");
    $stmt->bind_param("ssssssssss", $_SESSION['name'], $_SESSION['address'], $_SESSION['mobile'], $_SESSION['email'], $_SESSION['nic'], $_SESSION['dob'], $_SESSION['gender'], $_SESSION['role'], $_SESSION['username'], $hashed_password);

    // Debugging: Show the values being inserted
    echo "Inserting: Name={$_SESSION['name']}, Address={$_SESSION['address']}, Mobile={$_SESSION['mobile']}, Email={$_SESSION['email']}, NIC={$_SESSION['nic']}, DOB={$_SESSION['dob']}, Gender={$_SESSION['gender']}, Role={$_SESSION['role']}, Username={$_SESSION['username']}, Password Hash={$hashed_password}";

    if ($stmt->execute()) {
        $stmt->close();
        header('Location: therepy.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;  // Show MySQL error
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function updateProgress() {
            let totalFields = 10;
            let filledFields = 0;
            let inputs = document.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    filledFields++;
                }
            });

            let percentage = Math.floor((filledFields / totalFields) * 100);
            document.getElementById('progress').innerText = percentage + '%';
            document.getElementById('progress-bar').style.width = percentage + '%';
        }
    </script>
</head>
<body class="register-page">
    
    <div class="form-container">
        <h2>Medical Website Registration Form</h2>
        <div id="progress-bar-container">
            <div id="progress-bar"></div>
            <span id="progress" style="color: black;">0%</span>
        </div>
        <form method="POST" action="register.php" oninput="updateProgress()">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required>

            <label for="mobile">Mobile:</label>
            <input type="tel" name="mobile" id="mobile" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" required>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="role">Register as:</label>
            <select name="role" id="role" required>
                <option value="">Select</option>
                <option value="Patient">Patient</option>
                <!-- Add more roles as needed -->
            </select>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit">Register</button>
            <p>Go to <a href="login.php">login..!</a></p> 
        </form>
    </div>
    
</body>
</html>
