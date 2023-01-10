<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<div class="navbar-wrapper">
    <ul class="navbar">
        <li class="navbar-item">
            <a href="../views/home.php"> <img src="../public/images/logo.png" alt=""> </a>
        </li>
        <li class="navbar-item search">
            <form action="../actions/search.php" method="post">
                <input type="text" id="search" name="search" placeholder="Search...">
                <label for="search"></label>
            </form>
        </li>
        <li class="navbar-item">
            <div class="dropdown">
                <i class="fa-2x fa-solid fa-bars dropdown-icon"></i>
                <div class="dropdown-content">
                    <a href="../views/home.php" draggable="false">HOME</a>
                    <a href="../views/user-movies.php?user=<?php echo $_SESSION['user']; ?>" draggable="false">MY
                        MOVIES</a>
                    <a href="../views/profile.php?user=<?php echo $_SESSION['user']; ?>" draggable="false">PROFILE</a>
                    <a href="../actions/logout.php" draggable="false">LOGOUT</a>
                </div>
            </div>
        </li>
    </ul>
</div>