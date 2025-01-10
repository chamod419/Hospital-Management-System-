<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    /* Basic Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    }

    /* Heading Style */
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #4a4a4a;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Header Styles */
    th {
        background-color: #007BFF;
        color: white;
    }

    /* Row Hover Effect */
    tr:hover {
        background-color: #f1f1f1;
    }

    /* Responsive Styles */
    @media (max-width: 600px) {

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        th {
            display: none;
            /* Hide header on small screens */
        }

        tr {
            margin-bottom: 15px;
            /* Add spacing between rows */
        }

        td {
            text-align: right;
            padding-left: 50%;
            /* Align text */
            position: relative;
        }

        td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            width: calc(50% - 20px);
            padding-right: 10px;
            text-align: left;
            font-weight: bold;
        }
    }
</style>

<body>
<div class="header">
        <h1>Commets</h1>
        <a href="admin_Dashboard.php" class="logout-button">Dashboard</a>
    </div>
    <nav>
        <ul>

            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Patient <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="managePatient.php">Patients list.</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Psychologist <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">All Psychologist</a></li>
                    <li><a href="manageDoctor.php">Manage Psychologist</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Psychiatrist <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">All Psychiatrist</a></li>
                    <li><a href="manageDoctor.php">Manage Psychiatrist</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Payment<i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Payment list</a></li>
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

    <h2>Comments</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php

            include('../db/database.php');

            // Fetch comments from the database
            $query = "SELECT id, name, email, message, created_at FROM contacts";
            $result = $conn->query($query);

            if (!$result) {
                die("Query failed: " . $conn->error);
            }


            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
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