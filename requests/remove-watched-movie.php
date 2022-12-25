<?php
require_once '../functions/user.php';

$movieId = $_GET['movie'];
if (!hasReviewed($movieId)) {
    removeWatchedMovie($movieId);
}