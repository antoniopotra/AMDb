<link href="../public/css/navbar.css" rel="stylesheet" type="text/css">

<?php
function displayNavbar($location) {
    if ($location == 'home') { ?>
        <div class="navbar-wrapper">
            <ul class="navbar">
                <li class="navbar-item"><img src="../public/images/logo.png" alt=""></li>
                <li class="navbar-item">
                    <div class="dropdown">
                        <i class="fa-2x fa-solid fa-bars dropdown-icon"></i>
                        <div class="dropdown-content">
                            <a href="../views/home.php">HOME</a>
                            <a href="#">MY MOVIES</a>
                            <a href="#">PROFILE</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    <?php
    } else if ($location == 'my movies') { ?>
        <div class="navbar-wrapper">
            <ul class="navbar">
                <li class="navbar-item">LOGO</li>
                <li class="navbar-item">
                    <div class="dropdown">
                        <button class="dropdown-button">Right</button>
                        <div class="dropdown-content">
                            <a href="../views/home.php">HOME</a>
                            <a href="#">MY MOVIES</a>
                            <a href="#">PROFILE</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    <?php
    } else if ($location == 'profile') { ?>
        <div class="navbar-wrapper">
            <ul class="navbar">
                <li class="navbar-item">LOGO</li>
                <li class="navbar-item">
                    <div class="dropdown">
                        <button class="dropdown-button">Right</button>
                        <div class="dropdown-content">
                            <a href="../views/home.php">HOME</a>
                            <a href="#">MY MOVIES</a>
                            <a href="#">PROFILE</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    <?php
    }
    ?>
<?php } ?>