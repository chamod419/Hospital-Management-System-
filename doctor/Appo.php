<?php
session_start();
include('../db/database.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the current user's role and username from session
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Initialize an empty array to store appointments
$appointments = [];

// Confirm appointment function
if (isset($_GET['confirm_id'])) {
    $confirmId = $_GET['confirm_id'];

    // Fetch the appointment to confirm
    $stmt = $conn->prepare("SELECT user_name, age, mobile, doctor_name, appointment_date FROM appointment WHERE id = ?");
    $stmt->bind_param("i", $confirmId);  // Use the appointment id
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();

        // Insert into confirmedBooking table
        $stmt = $conn->prepare("INSERT INTO confirmedBooking (user_name, age, mobile, doctor_name, appointment_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $appointment['user_name'], $appointment['age'], $appointment['mobile'], $appointment['doctor_name'], $appointment['appointment_date']);
        $stmt->execute();

        // Delete the appointment from the appointment table
        $stmt = $conn->prepare("DELETE FROM appointment WHERE id = ?");
        $stmt->bind_param("i", $confirmId);  // Use the appointment id to delete
        $stmt->execute();

        echo "<script>alert('Appointment confirmed successfully!'); window.location.href = ''; </script>";
    }

    $stmt->close();
}


if ($role === 'Psychiatrist') {
    
    $stmt = $conn->prepare("SELECT id, user_name, age, mobile, doctor_name, appointment_date 
                             FROM appointment 
                             WHERE doctor_name = ?");
    $stmt->bind_param("s", $username);  
    $stmt->execute();
    $result = $stmt->get_result();

    
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
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

    /* Actions Link Styles */
    td a {
        text-decoration: none;
        color: #007bff;
        padding: 5px 10px;
        border: 1px solid transparent;
        border-radius: 5px;
    }

    td a:hover {
        background-color: #e7f0ff;
        border: 1px solid #007bff;
        color: #0056b3;
    }

    /* No Appointments Message */
    p {
        text-align: center;
        font-size: 1.2em;
        color: #999;
    }
</style>

<body>

    <?php if (empty($appointments)): ?>
        <p>No appointments found.</p>
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
                    <th>Actions</th> <!-- Add actions column for confirmation -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['age']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['mobile']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        <td>
                            <a href="?confirm_id=<?php echo htmlspecialchars($appointment['id']); ?>" onclick="return confirm('Are you sure you want to confirm this appointment?');">Confirm</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>

</html>