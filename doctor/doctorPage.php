<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psychiatrist Dashboard</title>
    <link rel="stylesheet" href="../admin/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="header">
        <h1> Dashboard</h1>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <nav>
        <ul>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Profile <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="../profile.php">Update Profile</a></li>
                    <li><a href="../resetPassword.php">Reset Password</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Manage Patient <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="Appointments.php">Booked Patient</a></li>
                    <li><a href="AvailableAppointment.php">Appointment Details</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Recommended Medicine <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="AddMedicine.php">Add Medicine</a></li>
                    <li><a href="medicine.php">View Recommendations</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <?php
    // Include your database connection
    include('../db/database.php');

    // Queries to get the counts from respective tables
    $patientCount = 0;
    $psychiatristCount = 0;
    $psychologistCount = 0;
    $appointmentCount = 0;

    // Query to get the count of all users with the role of 'patient', 'psychiatrist', and 'psychologist'
    $patientQuery = "SELECT COUNT(*) as count FROM user WHERE role = 'patient'";
    $psychiatristQuery = "SELECT COUNT(*) as count FROM user WHERE role = 'psychiatrist'";
    $psychologistQuery = "SELECT COUNT(*) as count FROM user WHERE role = 'psychologist'";

    $patientResult = $conn->query($patientQuery);
    if ($patientResult->num_rows > 0) {
        $patientRow = $patientResult->fetch_assoc();
        $patientCount = $patientRow['count'];
    }

    $psychiatristResult = $conn->query($psychiatristQuery);
    if ($psychiatristResult->num_rows > 0) {
        $psychiatristRow = $psychiatristResult->fetch_assoc();
        $psychiatristCount = $psychiatristRow['count'];
    }

    $psychologistResult = $conn->query($psychologistQuery);
    if ($psychologistResult->num_rows > 0) {
        $psychologistRow = $psychologistResult->fetch_assoc();
        $psychologistCount = $psychologistRow['count'];
    }

    // Query to get the count of confirmed bookings (appointments)
    $appointmentQuery = "SELECT COUNT(*) as count FROM confirmedbooking";
    $appointmentResult = $conn->query($appointmentQuery);
    if ($appointmentResult->num_rows > 0) {
        $appointmentRow = $appointmentResult->fetch_assoc();
        $appointmentCount = $appointmentRow['count'];
    }

    // Close the connection
    $conn->close();
    ?>

    <section class="dashboard-content">
        <div class="box">
            <p>Patient</p>
            <p><?php echo $patientCount; ?></p>
        </div>
        <div class="box">
            <p>Psychologist</p>
            <p><?php echo $psychologistCount; ?></p>
        </div>
        <div class="box">
            <p>Psychiatrist</p>
            <p><?php echo $psychiatristCount; ?></p>
        </div>
        <div class="box">
            <p>Appointments</p>
            <p><?php echo $appointmentCount; ?></p>
        </div>
    </section>

    <script>
        // JS for the dropdown menu functionality
        document.querySelectorAll('.dropdown-toggle').forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdownMenu = this.nextElementSibling;
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                    }
                });
                dropdownMenu.classList.toggle('show');
            });
        });

        window.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    </script>
</body>

</html>
