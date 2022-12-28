<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/user.php';
?>

    <div class="latest-movies">
        <h1>Recently added</h1>
        <div class="image-wrapper">
            <?php latestMovies(); ?>
        </div>
    </div>

    <div class="recommendations">
        <h1>Recommended movies</h1>
        <div class="image-wrapper">
            <?php recommendations(); ?>
        </div>
    </div>

<?php
include_once '../default/footer.php';
?>