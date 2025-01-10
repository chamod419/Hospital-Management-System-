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

// Fetch confirmed bookings for the logged-in user where doctor name matches
$queryBooking = "SELECT `id`, `user_name`, `age`, `mobile`, `doctor_name`, `appointment_date`, `created_at` 
                 FROM `confirmedBooking` 
                 WHERE `doctor_name` = ?";
$stmtBooking = $conn->prepare($queryBooking);
$stmtBooking->bind_param("s", $doctorName);
$stmtBooking->execute();
$resultBooking = $stmtBooking->get_result();

// Initialize an empty array to store confirmed bookings
$confirmedBookings = [];
if ($resultBooking->num_rows > 0) {
    // Store the confirmed bookings in an array
    while ($row = $resultBooking->fetch_assoc()) {
        $confirmedBookings[] = $row;
    }
}
$stmtBooking->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine</title>
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
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
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

        /* No Bookings Message */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #999;
        }

        /* Button Styles */
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .form-container {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Provide Medicine for Confirmed Bookings for Dr. <?php echo htmlspecialchars($doctorName); ?></h1>

    <?php if (empty($confirmedBookings)): ?>
        <p>No confirmed bookings found for this doctor.</p>
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
                    <th>Actions</th>
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
                        <td>
                            <div class="form-container">
                                <form action="" method="POST">
                                    <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['id']); ?>">
                                    <input type="hidden" name="user_name" value="<?php echo htmlspecialchars($booking['doctor_name']); ?>">
                                    <input type="text" name="medicine_name" placeholder="Enter Medicine Name" required>
                                    <input type="number" name="dosage" placeholder="Dosage (mg)" required>
                                    <button type="submit" class="button">Provide Medicine</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>

<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['booking_id'];
    $un = $_POST['user_name']; // Ensure this is fetched correctly from the form
    $medicineName = $_POST['medicine_name'];
    $dosage = $_POST['dosage'];

    // Prepare and bind the insert statement
    $queryInsert = "INSERT INTO `medicine` (`booking_id`, `user_name`, `medicine_name`, `dosage`) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($queryInsert);
    
    // Check if preparation was successful
    if ($stmtInsert) {
        $stmtInsert->bind_param("isss", $bookingId, $un, $medicineName, $dosage); // Adjusted types
        
        // Execute the statement and check for success
        if ($stmtInsert->execute()) {
            // Redirect back with success message
            header('Location: AddMedicine.php?success=1'); // Change to your page
            exit();
        } else {
            echo "Error: " . $stmtInsert->error;
        }
        
        $stmtInsert->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Debugging output
    }
}
?>
