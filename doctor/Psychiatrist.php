


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
                    <li><a href="Appo.php">Booked Patient</a></li>
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
    
    

    <script>
        // js for the drop menu prevent including #Href directly
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
