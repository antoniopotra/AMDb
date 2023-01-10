<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/actor.php';
?>

    <div class="image-wrapper-movie-page">
        <?php allStarring($_GET['actor']); ?>
    </div>

<?php include_once '../default/footer.php'; ?>