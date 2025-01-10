<?php
session_start();
include('../db/database.php');

// Fetch users with the role of "Patient"
$query = "SELECT `id`, `name`, `address`, `mobile`, `email`, `nic`, `dob`, `gender`, `role`, `username`, `created_at`, `reset_token` FROM `user` WHERE `role` = 'Patient'";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Handle deletion of a record
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM `user` WHERE `id` = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $delete_id);

    if ($delete_stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page to see changes
        exit();
    } else {
        echo "Error deleting record: " . $delete_stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Records</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Include your CSS file here -->
</head>
<style>
    /* Basic reset for margins and padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        /* Light gray background */
        color: #333;
        /* Dark text color */
        padding: 20px;
    }

    /* Header styles */
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        /* Remove space between table cells */
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for table */
    }

    thead {
        background-color: #007bff;
        /* Blue background for header */
        color: #fff;
        /* White text color */
    }

    th,
    td {
        padding: 12px;
        /* Cell padding */
        text-align: left;
        /* Align text to the left */
        border-bottom: 1px solid #ddd;
        /* Light gray border */
    }

    /* Row hover effect */
    tbody tr:hover {
        background-color: #f1f1f1;
        /* Light gray background on hover */
    }

    /* Action link styles */
    a {
        color: #ff4d4d;
        /* Red color for delete link */
        text-decoration: none;
        /* Remove underline */
    }

    a:hover {
        text-decoration: underline;
        /* Underline on hover */
    }

    /* Media queries for responsive design */
    @media (max-width: 768px) {
        table {
            font-size: 14px;
            /* Smaller font size for mobile */
        }

        th,
        td {
            padding: 8px;
            /* Reduced padding for smaller screens */
        }
    }
</style>

<body>

    <h2>Patient Records</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>NIC</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['nic']); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>