<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <div class="contact-section">
        <div class="contact-info">
            <div><i class="fa-solid fa-location-dot"></i> Gallery St, Art District, San Francisco, United States</div>
            <div><i class="fa-solid fa-envelope"></i> contact@gmail.com</div>
            <div><i class="fa-solid fa-phone"></i> +94 566 7892</div>
            <div><i class="fa-solid fa-clock"></i> Mon-Fri 8:00 AM to 12:00 AM</div>
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form class="contact" action="" method="post" onsubmit="return validateForm()">
                <input type="text" name="name" class="text-box" placeholder="Your Name" required>
                <input type="email" name="email" class="text-box" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <input type="submit" name="submit" class="send-btn" value="Send">
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.querySelector('input[name="name"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const message = document.querySelector('textarea[name="message"]').value;

            if (name.trim() === '' || email.trim() === '' || message.trim() === '') {
                alert('Please fill in all fields.');
                return false;
            }

            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert('Please enter a valid email address.');
                return false;
            }

            return true;
        }
    </script>

    <?php
    // Include the database connection file
    include('../db/database.php');

    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Get form data and sanitize it
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Your message has been sent successfully!');</script>";
            // Optionally clear the form fields after submission
            echo "<script>document.querySelector('form').reset();</script>";
        } else {
            echo "<script>alert('Error: Could not send your message. Please try again later.');</script>";
        }

        // Close the statement
        $stmt->close();
    }
    ?>

</body>
</html>
