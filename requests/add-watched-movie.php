<?php
require_once '../functions/user.php';

$movieId = $_GET['movie'];
addWatchedMovie($movieId);