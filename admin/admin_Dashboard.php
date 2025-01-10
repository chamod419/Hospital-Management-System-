<?php
session_start();
include('../db/database.php');

// Check if the user is logged in as an admin


// Initialize counts
$patientCount = 0;
$psychologistCount = 0;
$psychiatristCount = 0;

// Count patients
$result = $conn->query("SELECT COUNT(*) as count FROM user WHERE role = 'Patient'");
if ($result) {
    $row = $result->fetch_assoc();
    $patientCount = $row['count'];
}

// Count psychologists
$result = $conn->query("SELECT COUNT(*) as count FROM user WHERE role = 'Psychologist'");
if ($result) {
    $row = $result->fetch_assoc();
    $psychologistCount = $row['count'];
}

// Count psychiatrists
$result = $conn->query("SELECT COUNT(*) as count FROM user WHERE role = 'Psychiatrist'");
if ($result) {
    $row = $result->fetch_assoc();
    $psychiatristCount = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
    
    <nav>
        <ul>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Patient <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="managePatient.php">Patients List.</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Psychologist <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="manageDoctor.php">Manage Psychologist</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Psychiatrist <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="manageDoctor.php">Manage Psychiatrist</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Comments<i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="allComments.php">All Comments</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <section class="dashboard-content">
        <div class="box">
            <h2>Patients</h2>
            <p><?php echo $patientCount; ?></p> <!-- Display patient count -->
        </div>
        <div class="box">
            <h2>Psychologist</h2>
            <p><?php echo $psychologistCount; ?></p> <!-- Display psychologist count -->
        </div>
        <div class="box">
            <h2>Psychiatrist</h2>
            <p><?php echo $psychiatristCount; ?></p> <!-- Display psychiatrist count -->
        </div>
    </section>

    <script>
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
