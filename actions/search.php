<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/home.php');
    exit();
}

$search = $_POST['search'];
$search = strtoupper($search);
$_SESSION['search'] = $search;

header('location: ../views/movie-search.php');