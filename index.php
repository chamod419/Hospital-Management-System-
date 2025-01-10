<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psychological website</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: white;
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.38), rgba(0, 0, 0, 0)), url(images/front.avif) no-repeat;
            background-size: cover;
        }

        .box {
            width: 900px;
            float: right;
            border: 1px solid none;
        }

        .box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .box ul li {
            width: 120px;
            float: left;
            margin: 10px auto;
            text-align: center;
        }

        .box ul li a {
            text-decoration: none;
            color: darkgrey;
            transition: color 0.5s ease, background-color 0.5s ease;
        }

        .box ul li:hover {
            background-color: #861124;
            transition: background-color 0.5s ease;
        }

        .box ul li a:hover {
            color: white;
        }

        .wd {
            width: 300px;
            height: 539px;
            background-color: rgb(43, 39, 39);
            opacity: 0.9;
            padding: 55px;
        }

        .wd h1 {
            text-align: center;
            text-transform: uppercase;
            font-weight: 100px;
        }

        .wd h4 {
            text-align: justify;
            color: darkgrey;
            font-weight: normal;
        }

        .wd h2 {
            text-align: center;
            text-transform: uppercase;
            font-weight: normal;
            margin: 40px auto;
        }

        .opt form,
        input[type="button"] {
            background-color: black;
            color: white;
            padding: 10px;
            margin: -14px auto;
            padding-left: 50px;
            padding-right: 50px;
            text-align: center;
        }

        form,
        input[type="button"]:hover {
            background-color: #861124;
        }

        h1 span {
            color: black;
        }

        footer {
            background-color: #333;
            color: #ccc;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        footer a {
            color: #861124;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
        }

        /* Add a new class for the background image */
        .background {
            background-image: url('images/.jpg');
            /* Replace with your background image path */
            background-size: cover;
            background-position: center;
            position: absolute;
            /* Position it absolutely */
            top: 0;
            /* Align to top */
            right: 0;
            /* Align to right */
            width: 100%;
            /* Cover the full width */
            height: 100%;
            /* Cover the full height */
            z-index: -1;
            /* Place it behind other elements */
        }

        /* Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: gray;
            /* Black w/ opacity */
        }

        .modal-content {
            color: white;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="box">
        <ul>
            <li><a href="about.php">ABOUT US</a></li>
            <li><a href="patient/contact.php">CONTACT US</a></li>
            <li><a href="services.php">SERVICES</a></li>
            <li><a href="patient/games.php">GAMES</a></li>
            <li><a href="patient/books.php">BOOKS</a></li>
        </ul>

    </div>
    <div class="background">
    </div>
    <div class="wd">
        <h1>WELCOME TO ZENMINDSET<span>!!!</h1>
        <h4>
            At ZenMindSet, we are dedicated to providing comprehensive mental health support and resources for individuals seeking to enhance their well-being. Our platform connects you with qualified professionals, offering a range of psychological services tailored to your needs. Whether you are looking for counseling, therapy recommendations, or self-help resources, our user-friendly interface ensures easy navigation and access to essential tools for your mental health journey. Explore our diverse offerings, including expert articles, book recommendations, and interactive applications designed to foster personal growth and resilience. Join us at ZenMindSet, where we empower you to prioritize your mental health and cultivate a balanced life.
        </h4>
        <div class="opt">
            <button class="register-button" id="registerBtn">Login here..!</button>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 ZenMindSet. All rights reserved.</p>
        <p>Follow us on
            <a href="https://twitter.com" target="_blank">Twitter</a>,
            <a href="https://facebook.com" target="_blank">Facebook</a>, and
            <a href="https://instagram.com" target="_blank">Instagram</a>.
        </p>
    </footer>
    <!-- Modal for Registration -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Register Now</h2>
            <p>Click the button below to proceed to the registration page.</p>
            <button onclick="location.href='login.php'" style="padding: 10px 20px; background-color: #861124; color: white; border: none; cursor: pointer;">Go to Login</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Add event listeners for menu links
            const menuLinks = document.querySelectorAll('.box ul li a');
            menuLinks.forEach(link => {
                link.addEventListener('mouseover', () => {
                    link.style.color = 'white';
                    link.parentElement.style.backgroundColor = '#861124';
                });
                link.addEventListener('mouseout', () => {
                    link.style.color = 'darkgrey';
                    link.parentElement.style.backgroundColor = 'transparent';
                });
            });

            // Modal functionality
            const registerBtn = document.getElementById('registerBtn');
            const modal = document.getElementById('registerModal');
            const closeModal = document.getElementById('closeModal');

            // Show modal on button click
            registerBtn.onclick = function() {
                modal.style.display = "block";
            }

            // Close modal when (x) is clicked
            closeModal.onclick = function() {
                modal.style.display = "none";
            }

            // Close modal when clicking outside of the modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Add event listeners for menu links
            const menuLinks = document.querySelectorAll('.box ul li a');
            menuLinks.forEach(link => {
                link.addEventListener('mouseover', () => {
                    link.style.color = 'white';
                    link.parentElement.style.backgroundColor = '#861124';
                });
                link.addEventListener('mouseout', () => {
                    link.style.color = 'darkgrey';
                    link.parentElement.style.backgroundColor = 'transparent';
                });
            });

            // Add event listener for form button if needed in the future
            const formButton = document.querySelector('.opt input[type="button"]');
            if (formButton) {
                formButton.addEventListener('click', () => {
                    alert('Form button clicked!');
                });
            }
        });
    </script>
</body>

</html>