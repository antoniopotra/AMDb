<link href="../public/css/home.css" rel="stylesheet" type="text/css">

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/movie.php';
?>

<div class="latest-movies">
    <h1>Recently added</h1>
    <div class="image-wrapper">
        <?php loadLatestMovies(); ?>
    </div>
</div>

<div class="recommendations">
    <h1>Recommended movies</h1>
    <div class="image-wrapper">
        <?php loadRecommendations(); ?>
    </div>
</div>

<?php
include_once '../default/footer.php';
?>