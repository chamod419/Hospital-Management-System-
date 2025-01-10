<?php
session_start();
include('../db/database.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

$username = $_SESSION['username'];
$error = '';
$success = '';
$appointments = [];

// Fetch the list of doctors from the database
$stmt = $conn->prepare("SELECT username FROM user WHERE role = 'Psychiatrist'");
$stmt->execute();
$doctors = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $doctor_name = $_POST['doctor_name'];

    // Validate input data
    if (empty($name) || empty($age) || empty($mobile) || empty($doctor_name)) {
        $error = "Please fill in all fields.";
    } else {
        // Get the current date for the appointment
        $appointment_date = date("Y-m-d H:i:s"); // Current date and time

        // Insert appointment into the database
        $stmt = $conn->prepare("INSERT INTO appointment (user_name, age, mobile, doctor_name, appointment_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $age, $mobile, $doctor_name, $appointment_date);

        if ($stmt->execute()) {
            $success = "Appointment booked successfully!";
        } else {
            $error = "Error booking appointment: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Fetch all appointments from the appointment table
$stmt = $conn->prepare("SELECT id, user_name, age, mobile, doctor_name, appointment_date FROM appointment WHERE 1");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Include your CSS here -->
</head>
<style>
    /* Reset some default styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        line-height: 1.6;
    }

    /* Form container */
    .form-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Heading styles */
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Form element styles */
    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="tel"],
    select {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="tel"]:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Button styles */
    button {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Message styles */
    p {
        text-align: center;
        margin: 10px 0;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Link styles */
    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="form-container">
        <h2>Make Appointment for Psychologist</h2>

        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST" action="makeAppontment.php">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="age">Your Age:</label>
            <input type="number" name="age" id="age" required>

            <label for="mobile">Mobile Number:</label>
            <input type="tel" name="mobile" id="mobile" required>

            <label for="doctor_name">Select Doctor:</label>
            <select name="doctor_name" id="doctor_name" required>
                <option value="">Select a doctor</option>
                <?php while ($doctor = $doctors->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($doctor['username']); ?>">
                        <?php echo htmlspecialchars($doctor['username']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Book Appointment</button>
        </form>

        <h2>Appointments List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($appointments)): ?>
                    <tr>
                        <td colspan='6'>No appointments found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['age']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['mobile']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>

</html>