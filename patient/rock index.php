<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JavaScript Game | Rock Paper Scissors</title>
    <link rel="stylesheet" href="style/rock style.css" />
</head>
<body>
    <section class="container">
        <div class="result_field">
            <div class="result_images">
                <!-- User result image -->
                <span class="user_result">
                    <img src="images/rock.png" alt="User choice">
                </span>
                <!-- CPU result image -->
                <span class="cpu_result">
                    <img src="images/rock.png" alt="CPU choice">
                </span>
            </div>
            <!-- Result text -->
            <div class="result">Let's Play!!</div>
        </div>

        <div class="option_images">
            <!-- Rock option -->
            <span class="option_image">
                <img src="images/rock.png" alt="Rock">
                <p>Rock</p>
            </span>
            <!-- Paper option -->
            <span class="option_image">
                <img src="images/paper.png" alt="Paper">
                <p>Paper</p>
            </span>
            <!-- Scissors option -->
            <span class="option_image">
                <img src="images/scissors.png" alt="Scissors">
                <p>Scissors</p>
            </span>
        </div>
    </section>

    <script src="js/rock script.js" defer></script>
</body>
</html>
