<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Times New Roman', Times, serif;

    }

    .container {
        min-height: 100vh;
        width: 100%;
        background-color: #191a2b;
    }

    .service-wrapper {
        padding: 5% 8%;

    }

    .service {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1 {
        color: white;
        font-size: 5rem;
        -webkit-text-stroke-width: 2px;
        -webkit-text-stroke-color: transparent;
        letter-spacing: 4px;
        background-color: rgba(4, 52, 83);
        background: linear-gradient(8deg, rgba(8, 52, 83, 1) 0%, rgba(0, 230, 173, 1)41% rgba(41, 17, 45, 1)100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;


    }

    h1:after {
        content: "";
        position: absolute;
        top: 100%;
        left: 10%;
        height: 8px;
        width: 80%;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.05);
    }

    h1 span {
        position: absolute;
        top: 100%;
        left: 10%;
        height: 8px;
        width: 8px;
        border-radius: 50%;
        background-color: #72e2ae;
        animation: anim 5s linear infinite;
    }

    @keyframes anim {
        95% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            left: 88%;
        }

    }

    .cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 80px;
    }

    .card {
        height: 350px;
        width: 370px;
        background-color: #1c2335;
        padding: 3% 8%;
        border: 0.2px solid rgba(114, 226, 174, 0.2);
        border-radius: 8px;
        transition: .6s;
        display: flex;
        align-items: center;
        flex-direction: column;
        position: relative;
        overflow: hidden;


    }

    .card:after {
        content: "";
        position: absolute;
        top: 150%;
        left: -200px;
        width: 120%;
        transform: rotate(50deg);
        background-color: white;
        height: 18px;
        filter: blur(30px);
        opacity: 0.5;
        transition: 1s;
    }

    .card:hover:after {
        width: 225%;
        top: -100%;


    }

    .card i {
        color: #72e2ae;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 4.8rem;
    }

    .card h2 {
        color: white;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .card p {
        text-align: center;
        width: 100%;
        margin: 12px 0;
        color: rgb(255, 255, 255, 0.6);

    }

    .card:hover {
        background-color: transparent;
        transform: translateY(-8px);
        border-color: black;
    }

    .card:hover i {
        color: black;
    }

    @media screen and (max-width:900px) {
        .cards {
            grid-template-columns: repeat(2, 1fr);
        }

        h1 {
            font-size: 3.5rem;
        }
    }
</style>

<body>
    <div class="container">
        <div class="service-wrapper">
            <div class="service">
                <h1>Our Services<span></span></h1>
                <div class="cards">
                    <div class="card">
                        <i class="fa-solid fa-user-group"></i>
                        <h2>Customer Satisfaction</h2>
                        <p>Enhanced dining experience with efficient services, quality food, and responsive customer
                            support, ensuring patrons leave satisfied and eager to return.</p>
                    </div>

                    <div class="card">
                        <i class="fa-solid fa-uncharted"></i>
                        <h2>Interactive Application</h2>
                        <p>A user-friendly web-based platform allowing seamless browsing, reservations, and orders,
                            providing a modern and engaging experience for customers.</p>
                    </div>
                    <div class="card">
                        <i class="fa-solid fa-user-md"></i>
                        <h2>Psychologist/Psychiatrist Selection</h2>
                        <p>Dynamic selection process for choosing the appropriate psychologist or psychiatrist. Utilize our Google Form to ensure a personalized match based on your needs, preferences, and mental health requirements.</p>
                    </div>

                    <div class="card">
                        <i class="fa-solid fa-user-therapist"></i>
                        <h2>Real-Time Therapy and Medical Recommendations</h2>
                        <p>Access real-time therapy sessions and personalized medical recommendations tailored to your needs. Our qualified professionals are here to support you on your mental health journey.</p>
                    </div>


                    <div class="card">
                        <i class="fa-brands fa-cc-mastercard"></i>
                        <h2>Special Promotions</h2>
                        <p>Attractive offers and discounts regularly updated to entice customers, adding value to their
                            dining experience.</p>
                    </div>

                    <div class="card">
                        <i class="fa-regular fa-registered"></i>
                        <h2>Pre-Orders</h2>
                        <p>Allowing customers to place orders in advance, ensuring prompt service and minimizing wait
                            times, enhancing overall satisfaction.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>

</html>