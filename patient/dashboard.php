<?php
// Include the database connection file
include '../db/database.php'; // Adjust the path if necessary

// SQL query to count all confirmed bookings
$sql = "SELECT COUNT(*) AS totalAppointments FROM confirmedbooking";
$result = $conn->query($sql);

// Get the count
$totalAppointments = 0;
if ($result->num_rows > 0) {
    // Fetch the count
    $row = $result->fetch_assoc();
    $totalAppointments = $row['totalAppointments'];
}

// No need to close the connection if you're using it elsewhere in your application
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="header">
        <h1>Patient Dashboard</h1>
        <a href="logout.php" class="logout-button">Logout</a>
        <a href="contact.php" class="contact-button" style="background-color: white; color:black;">Contact us</a>
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
                <a class="dropdown-toggle" href="#">Books <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="books.php">Available Book</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Book Appointment <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="makeBooking.php">Book Psychiatrist</a></li>
                    <li><a href="makeAppontment.php">Book Psychologist</a></li>
                    <li><a href="bookings.php">Confirmed Bookings</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Games <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="games.php">Play Games</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Medicine <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="medinine.php">Medicine</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <section class="dashboard-content">
        <div class="box">
            <h2>Appointments</h2>
            <p><?php echo $totalAppointments; ?></p>
        </div>
    </section>


    <script>
        // js for the drop menu prevent including #Href directly
        document.querySelectorAll('.dropdown-toggle').forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link action
                const dropdownMenu = this.nextElementSibling;
                
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                    }
                });

                dropdownMenu.classList.toggle('show');
            });
        });

        document.querySelectorAll('.dropdown-submenu > a').forEach(submenu => {
            submenu.addEventListener('click', function(e) {
                e.preventDefault();
                const submenuDropdown = this.nextElementSibling;
                
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== submenuDropdown) {
                        menu.classList.remove('show');
                    }
                });

                submenuDropdown.classList.toggle('show');
            });
        });
        
        window.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle, .dropdown-submenu > a')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>
