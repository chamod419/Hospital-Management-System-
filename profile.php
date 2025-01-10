<?php
session_start();
include('db/database.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the current user's username
$username = $_SESSION['username'];

// Fetch user details from the database
$stmt = $conn->prepare("SELECT `id`, `name`, `address`, `mobile`, `email`, `nic`, `dob`, `gender`, `role`, `username` FROM `user` WHERE `username` = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Check if user data was found
if (!$user) {
    die("User not found.");
}

// Handle form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    // Update user details in the database
    $updateStmt = $conn->prepare("UPDATE `user` SET `name` = ?, `address` = ?, `mobile` = ?, `email` = ?, `nic` = ?, `dob` = ?, `gender` = ? WHERE `username` = ?");
    $updateStmt->bind_param("ssssssss", $name, $address, $mobile, $email, $nic, $dob, $gender, $username);
    
    if ($updateStmt->execute()) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Failed to update profile. Please try again.";
    }
    $updateStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .profile-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            margin-top: 10px;
            display: block;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>

        <?php if (isset($success)): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="profile.php">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="nic">NIC:</label>
            <input type="text" name="nic" id="nic" value="<?php echo htmlspecialchars($user['nic']); ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="Male" <?php echo ($user['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($user['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo ($user['gender'] === 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
