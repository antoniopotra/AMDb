<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMDb</title>
    <link href="../public/css/colors.css" rel="stylesheet" type="text/css">
    <link href="../public/css/welcome.css" rel="stylesheet" type="text/css">
    <script src="../public/js/welcome.js"></script>
    <script src="https://kit.fontawesome.com/a20944aa28.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container" id="container">
        <img src="../public/images/welcome-background.jpg" alt="">

        <div class="inner-container">
            <div class="text-container">
                <h1>AMDb</h1>
                <h2>Your portal to the movie world</h2>
            </div>

            <div class="button-container">
                <button onclick="openForm('log-in-form')">Log In</button>
                <button onclick="openForm('sign-up-form')">Sign Up</button>
            </div>
        </div>
    </div>

    <div class="form-popup" id="log-in-form">
        <form>
            <h2>Log In</h2>

            <div class="input-container">
                <input type="text" placeholder="Username" id="log-username" required>
                <label for="log-username">Username</label>
            </div>

            <div class="input-container">
                <input type="password" placeholder="Password" id="log-password" required>
                <label for="log-password">Password</label>
            </div>

            <button type="submit">Log In</button>
            <button onclick="closeForm('log-in-form')">Close</button>
        </form>
    </div>

    <div class="form-popup" id="sign-up-form">
        <form>
            <h2>Sign Up</h2>

            <div class="input-container">
                <input type="email" placeholder="Email" id="sign-email" required>
                <label for="sign-email">Email</label>
            </div>

            <div class="input-container">
                <input type="text" placeholder="Username" id="sign-username" required>
                <label for="sign-username">Username</label>
            </div>

            <div class="input-container">
                <input type="password" placeholder="Password" id="sign-password" required>
                <label for="sign-password">Password</label>
            </div>

            <div class="input-container">
                <input type="password" placeholder="Repeat password" id="sign-repeat-password" required>
                <label for="sign-repeat-password">Repeat password</label>
            </div>

            <button type="submit">Sign Up</button>
            <button onclick="closeForm('sign-up-form')">Close</button>
        </form>
    </div>

    <div class="how-it-works">
        <div class="set">
            <i class="fa-4x fa-regular fa-user"></i>
            <p>Create an account</p>
        </div>

        <div class="set">
            <i class="fa-4x fa-solid fa-clapperboard"></i>
            <p>Track your movies</p>
        </div>

        <div class="set">
            <i class="fa-4x fa-solid fa-globe"></i>
            <p>See what other people watch</p>
        </div>
    </div>
</body>
</html>