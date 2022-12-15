<?php session_start(); ?>

<link href="../public/css/welcome.css" rel="stylesheet" type="text/css">
<script src="../public/js/welcome.js"></script>

<?php
include_once '../default/header.php';
?>

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
    <form action="../actions/log-in.php" method="post">
        <h2>Log In</h2>

        <div class="input-container">
            <input type="text" placeholder="Username" id="log-username" name="username" required>
            <label for="log-username">Username</label>
        </div>

        <div class="input-container">
            <input type="password" placeholder="Password" id="log-password" name="password" required>
            <label for="log-password">Password</label>
        </div>

        <h6>
            <?php
            echo $_SESSION['log-in-error'];
            $_SESSION['log-in-error'] = "";
            ?>
        </h6>

        <button type="submit">Log In</button>
        <button onclick="closeForm('log-in-form')">Close</button>
    </form>
</div>

<div class="form-popup" id="sign-up-form">
    <form action="../actions/sign-up.php" method="post">
        <h2>Sign Up</h2>

        <div class="input-container">
            <input type="text" placeholder="Full name" id="sign-full-name" name="full-name" required>
            <label for="sign-full-name">Full name</label>
        </div>

        <div class="input-container">
            <input type="text" placeholder="Username" id="sign-username" name="username" required>
            <label for="sign-username">Username</label>
        </div>

        <div class="input-container">
            <input type="email" placeholder="Email" id="sign-email" name="email" required>
            <label for="sign-email">Email</label>
        </div>

        <div class="input-container">
            <input type="password" placeholder="Password" id="sign-password" name="password" required>
            <label for="sign-password">Password</label>
        </div>

        <div class="input-container">
            <input type="password" placeholder="Repeat password" id="sign-repeat-password" name="repeat-password" required>
            <label for="sign-repeat-password">Repeat password</label>
        </div>

        <h6>
            <?php
            echo $_SESSION['sign-up-error'];
            $_SESSION['sign-up-error'] = "";
            ?>
        </h6>

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

<?php
include_once '../default/footer.php';
?>