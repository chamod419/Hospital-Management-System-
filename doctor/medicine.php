<?php
session_start();
include('../db/database.php'); // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the current user's username
$username = $_SESSION['username'];

// Fetch the user ID for the logged-in user
$queryUser = "SELECT `id`, `username` FROM `user` WHERE `username` = ?";
$stmtUser = $conn->prepare($queryUser);

// Check if statement preparation was successful
if (!$stmtUser) {
    die("SQL error: " . $conn->error);
}

$stmtUser->bind_param("s", $username);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$userData = $resultUser->fetch_assoc();
$stmtUser->close();

// Check if user data was found
if (!$userData) {
    die("User not found.");
}

$userId = $userData['id'];
$doctorName = $userData['username'];

// Fetch medicine details for the logged-in user
$queryMedicine = "SELECT m.`id`, m.`medicine_name`, m.`dosage`, b.`user_name` 
                  FROM `medicine` m 
                  JOIN `confirmedBooking` b ON m.`booking_id` = b.`id` 
                  WHERE b.`doctor_name` = ?";
$stmtMedicine = $conn->prepare($queryMedicine);

// Check if statement preparation was successful
if (!$stmtMedicine) {
    die("SQL error: " . $conn->error);
}

$stmtMedicine->bind_param("s", $username);
$stmtMedicine->execute();
$resultMedicine = $stmtMedicine->get_result();

// Initialize an empty array to store medicine details
$medicines = [];
if ($resultMedicine->num_rows > 0) {
    // Store the medicine details in an array
    while ($row = $resultMedicine->fetch_assoc()) {
        $medicines[] = $row;
    }
}
$stmtMedicine->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Details</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Centered Heading Style */
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* No Medicines Message */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Medicine Details </h1>

    <?php if (empty($medicines)): ?>
        <p>No medicine details found for this user.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Medicine Name</th>
                    <th>Dosage (mg)</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicines as $medicine): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($medicine['id']); ?></td>
                        <td><?php echo htmlspecialchars($medicine['medicine_name']); ?></td>
                        <td><?php echo htmlspecialchars($medicine['dosage']); ?></td>
                        <td><?php echo htmlspecialchars($medicine['user_name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
