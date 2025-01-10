<?php
session_start();
include('../db/database.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the logged-in user's username
$username = $_SESSION['username'];

// Initialize an empty array to store confirmed bookings for the logged-in user
$confirmedBookings = [];

// Fetch confirmed bookings for the logged-in user
$stmt = $conn->prepare("SELECT cb.id, cb.user_name, cb.age, cb.mobile, cb.doctor_name, cb.appointment_date, cb.created_at 
                         FROM confirmedBooking AS cb 
                         JOIN User AS u ON cb.user_name = u.username 
                         WHERE u.username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Store the confirmed bookings in an array
while ($row = $result->fetch_assoc()) {
    $confirmedBookings[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmed Bookings</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Link your CSS file here -->
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Container for heading and table */
        h1 {
            text-align: center;
            color: #5a5a5a;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
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

        /* No Bookings Message */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #999;
        }
    </style>
</head>

<body>
    <h1>Your Confirmed Bookings</h1>

    <?php if (empty($confirmedBookings)): ?>
        <p>No confirmed bookings found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($confirmedBookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['age']); ?></td>
                        <td><?php echo htmlspecialchars($booking['mobile']); ?></td>
                        <td><?php echo htmlspecialchars($booking['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
