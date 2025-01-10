<?php
session_start();
include('db/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Default admin credentials
    if ($username === 'admin' && $password === 'admin1234') {
        $_SESSION['username'] = 'admin';
        header('Location: admin/admin_Dashboard.php'); 
        exit();
    }

    // Fetch user from database
    $stmt = $conn->prepare("SELECT * FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];  // Store the user role in session
        
        // Redirect based on user role
        if ($user['role'] === 'Psychologist') {
            header('Location: doctor/doctorPage.php');
        } elseif ($user['role'] === 'Patient') {
            header('Location: patient/dashboard.php');
        } elseif($user['role'] === 'Psychiatrist'){
            header('Location: doctor/Psychiatrist.php');
        }
        else {
            $error = "Unknown role detected.";
        }
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="login-page">
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <div id="password-container" style="display: none;">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit">Login</button>
        </form>

        <p><a href="forgotPassword.php">Forgot Password?</a></p> <!-- Added forgot password link -->
        <p><a href="register.php">Sign up..!</a> to create a account</p> 
    </div>

    <script>
        const usernameInput = document.getElementById('username');
        const passwordContainer = document.getElementById('password-container');

        usernameInput.addEventListener('blur', function() {
            if (usernameInput.value.trim() !== '') {
                passwordContainer.style.display = 'block';
            }
        });
    </script>
</body>
</html>

