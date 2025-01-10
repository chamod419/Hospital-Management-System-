<?php
include '../db/database.php'; // Database connection file

// Initialize variables
$id = "";
$name = "";
$address = "";
$mobile = "";
$email = "";
$nic = "";
$dob = "";
$gender = "";
$role = "";
$username = "";
$password = "";
$error = "";
$success = "";

// Insert new user
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password before saving

    $query = "INSERT INTO `user` (`name`, `address`, `mobile`, `email`, `nic`, `dob`, `gender`, `role`, `username`, `password`) 
              VALUES ('$name', '$address', '$mobile', '$email', '$nic', '$dob', '$gender', '$role', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        $success = "New user added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Update user
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $username = $_POST['username'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE `user` SET `name`='$name', `address`='$address', `mobile`='$mobile', `email`='$email', `nic`='$nic', `dob`='$dob', 
                  `gender`='$gender', `role`='$role', `username`='$username', `password`='$password' WHERE `id`='$id'";
    } else {
        $query = "UPDATE `user` SET `name`='$name', `address`='$address', `mobile`='$mobile', `email`='$email', `nic`='$nic', `dob`='$dob', 
                  `gender`='$gender', `role`='$role', `username`='$username' WHERE `id`='$id'";
    }

    if (mysqli_query($conn, $query)) {
        $success = "User details updated successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM `user` WHERE `id`='$id'";

    if (mysqli_query($conn, $query)) {
        $success = "User deleted successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Fetch all users
$result = mysqli_query($conn, "SELECT `id`, `name`, `address`, `mobile`, `email`, `nic`, `dob`, `gender`, `role`, `username` FROM `user` WHERE `role` IN ('Psychologist', 'Psychiatrist')");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage Psychologist</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    /* General styling for the container */
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    /* Styling for headings */
    .container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    /* Styling for error and success messages */
    .error {
        color: red;
        text-align: center;
    }

    .success {
        color: green;
        text-align: center;
    }

    /* Styling for the form */
    form {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 15px;
    }

    form label {
        flex-basis: 100%;
        font-weight: bold;
        color: #555;
    }

    form input,
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    form button {
        width: 48%;
        padding: 10px;
        background-color: #5cb85c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #4cae4c;
    }

    /* Styling for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    td a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    td a:hover {
        color: #0056b3;
    }

    /* Make the table responsive on smaller screens */
    @media (max-width: 768px) {
        form {
            flex-direction: column;
        }

        form button {
            width: 100%;
        }

        table,
        th,
        td {
            font-size: 14px;
        }

        table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<body>
    <div class="header">
        <h1>Manage Doctor Details</h1>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <nav>
        <ul>

            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Patient <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Patients list.</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Psychologist <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">All Psychologist</a></li>
                    <li><a href="#">Manage Psychologist</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Psychiatrist <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">All Psychiatrist</a></li>
                    <li><a href="#">Manage Psychiatrist</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#">Payment<i class="fas fa-caret-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Payment list</a></li>
                </ul>
            </li>

        </ul>
    </nav>

    <div class="container">
        <h2>Add/Update User</h2>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <?php if ($success) echo "<p class='success'>$success</p>"; ?>

        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo isset($user['id']) ? $user['id'] : ''; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>

            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo isset($user['address']) ? $user['address'] : ''; ?>" required>

            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" value="<?php echo isset($user['mobile']) ? $user['mobile'] : ''; ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>

            <label for="nic">NIC:</label>
            <input type="text" name="nic" value="<?php echo isset($user['nic']) ? $user['nic'] : ''; ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" value="<?php echo isset($user['dob']) ? $user['dob'] : ''; ?>" required>

            <label for="gender">Gender:</label>
            <select name="gender">
                <option value="Male" <?php echo (isset($user['gender']) && $user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (isset($user['gender']) && $user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>

            <label for="role">Role:</label>
            <select name="role">
                <option value="Psychologist" <?php echo (isset($user['role']) && $user['role'] == 'Psychologist') ? 'selected' : ''; ?>>Psychologist</option>
                <option value="Psychiatrist" <?php echo (isset($user['role']) && $user['role'] == 'Psychiatrist') ? 'selected' : ''; ?>>Psychiatrist</option>
            </select>

            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>" required>

            <label for="password">Password (leave blank to keep current):</label>
            <input type="password" name="password">

            <button type="submit" name="add">Add User</button>
            <button type="submit" name="update">Update User</button>
        </form>

        <h2>Users List</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>NIC</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['nic']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

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