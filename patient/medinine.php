<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>

<h1>Medicine List</h1>

<?php
include('../db/database.php'); // Include your database connection

// SQL Query to fetch medicine data
$sql = "SELECT id, booking_id, user_name, medicine_name, dosage, quantity, notes, provided_at FROM medicine WHERE 1";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>User Name</th>
                <th>Medicine Name</th>
                <th>Dosage</th>
                <th>Quantity</th>
                <th>Notes</th>
                <th>Provided At</th>
            </tr>
          </thead>";
    echo "<tbody>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['medicine_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dosage']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['notes']) . "</td>";
        echo "<td>" . htmlspecialchars($row['provided_at']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No data found.</p>";
}

// Close the connection
$conn->close();
?>

</body>
</html>
