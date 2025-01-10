

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="about-wrapper">
        <div class="about-left">
            <div class="about-left-content">
                <div>
                    <div class="shadow">
                        <div class="about-img">
                            <img src="images/img.jpg" alt="about image">
                        </div>
                    </div>
                    <h2>About Us</h2>
                    <h3>ZenMindSet</h3>
                </div>
                <ul class="icons">
                    <li><i class="fab fa-facebook-f"></i></li>
                    <li><i class="fab fa-twitter"></i></li>
                    <li><i class="fab fa-linkedin"></i></li>
                    <li><i class="fab fa-instagram"></i></li>
                </ul>
            </div>
        </div>
        <div class="about-right">
            <h1>WELCOME<span>!</span></h1>
            <br> <br>
            <div class="about-para">
                <h2>WHO WE ARE<span>?</span></h2>
                <p>Welcome to ZenMindSet, where we prioritize your mental health and well-being. Our platform connects individuals with experienced psychologists and counselors, providing the support you need on your mental health journey.</p>
                
                <h2>MISSION</h2>
                <p>Our mission is to empower individuals through accessible mental health resources and personalized support, fostering a community where mental well-being is prioritized and stigma is challenged.</p>
                
                <h2>VISION</h2>
                <p>Our vision is to create a world where everyone has access to the mental health care they deserve, ensuring that mental health becomes a fundamental part of overall health and well-being.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Add event listeners for social media icons if needed
            const socialIcons = document.querySelectorAll('.icons li i');
            socialIcons.forEach(icon => {
                icon.addEventListener('click', () => {
                    const platform = icon.classList[1].split('-')[1];
                    alert(`Redirecting to our ${platform.charAt(0).toUpperCase() + platform.slice(1)} page`);
                    // Add your social media page URLs here
                    if(platform === 'facebook') window.location.href = 'https://www.facebook.com/yourpage';
                    if(platform === 'twitter') window.location.href = 'https://www.twitter.com/yourpage';
                    if(platform === 'linkedin') window.location.href = 'https://www.linkedin.com/yourpage';
                    if(platform === 'instagram') window.location.href = 'https://www.instagram.com/yourpage';
                });
            });

            // Example of expanding/contracting text sections
            const expandableSections = document.querySelectorAll('.about-para h2');
            expandableSections.forEach(section => {
                section.addEventListener('click', () => {
                    const nextElement = section.nextElementSibling;
                    if(nextElement.style.display === 'none' || nextElement.style.display === '') {
                        nextElement.style.display = 'block';
                    } else {
                        nextElement.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
