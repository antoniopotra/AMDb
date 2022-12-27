<?php
session_start();

if (isset($_SESSION['user'])) {
    header('location: ../views/home.php');
    exit();
}

include_once '../default/header.php';
?>

    <div id="welcome-container">
        <div class="welcome-container">
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

        <div class="how-it-works">
            <div class="set">
                <i class="fa-4x fa-solid fa-user"></i>
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

            <input type="submit" class="btn" value="Log In" id="log-in-submit">
            <label for="log-in-submit"></label>

            <input onclick="closeForm('log-in-form')" class="btn" value="Close" id="log-in-close">
            <label for="log-in-close"></label>
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
                <input type="password" placeholder="Repeat password" id="sign-repeat-password" name="repeat-password"
                       required>
                <label for="sign-repeat-password">Repeat password</label>
            </div>

            <h6>
                <?php
                echo $_SESSION['sign-up-error'];
                $_SESSION['sign-up-error'] = "";
                ?>
            </h6>

            <input type="submit" class="btn" value="Sign Up" id="sign-up-submit">
            <label for="sign-up-submit"></label>

            <input onclick="closeForm('sign-up-form')" class="btn" value="Close" id="sign-up-close">
            <label for="sign-up-close"></label>
        </form>
    </div>

<?php
include_once '../default/footer.php';
?>