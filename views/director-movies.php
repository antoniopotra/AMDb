<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/director.php';
?>

    <div class="image-wrapper-movie-page">
        <?php allDirected($_GET['director']); ?>
    </div>

<?php include_once '../default/footer.php'; ?>