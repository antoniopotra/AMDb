<link href="../public/css/home.css" rel="stylesheet" type="text/css">

<?php
include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/database.php';
require_once '../functions/movie.php';
require_once '../functions/user.php';

$db = dbConnect();
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
        <?php loadUserRecommendations(); ?>
    </div>
</div>

<?php
include_once '../default/footer.php';
?>