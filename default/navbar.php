<link href="../public/css/navbar.css" rel="stylesheet" type="text/css">

<?php
function displayNavbar($location) {
    if ($location == 'home') { ?>
        <div class="menu-wrapper">
            <ul class="menu">
                <li class="menu-item">LOGO</li>
                <li class="menu-item"><a href="../views/home.php" style="color: var(--orange);">HOME</a></li>
                <li class="menu-item">MY MOVIES</li>
                <li class="menu-item">PROFILE</li>
                <li class="menu-item"><i class="fa-solid fa-magnifying-glass"></i></li>
            </ul>
        </div>
    <?php
    } else if ($location == 'my movies') { ?>
        <div class="menu-wrapper">
            <ul class="menu">
                <li class="menu-item">LOGO</li>
                <li class="menu-item"><a href="../views/home.php">HOME</a></li>
                <li class="menu-item" style="color: var(--orange);">MY MOVIES</li>
                <li class="menu-item">PROFILE</li>
                <li class="menu-item"><i class="fa-solid fa-magnifying-glass"></i></li>
            </ul>
        </div>
    <?php
    } else if ($location == 'profile') { ?>
        <div class="menu-wrapper">
            <ul class="menu">
                <li class="menu-item">LOGO</li>
                <li class="menu-item"><a href="../views/home.php">HOME</a></li>
                <li class="menu-item">MY MOVIES</li>
                <li class="menu-item" style="color: var(--orange);">PROFILE</li>
                <li class="menu-item"><i class="fa-solid fa-magnifying-glass"></i></li>
            </ul>
        </div>
    <?php
    }
    ?>
<?php } ?>