<?php
session_start();

require_once '../functions/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$db = dbConnect();

$query = pg_query($db, "select username from person where username = '$username'");
if (pg_num_rows($query) != 1) {
    $_SESSION['log-in-error'] = "Username doesn't exist.";
    header('location: ../views/welcome.php');
    exit();
}

$query = pg_query($db, "select password from person where username = '$username' and password = '$password'");
if (pg_num_rows($query) != 1) {
    $_SESSION['log-in-error'] = "Incorect password.";
    header('location: ../views/welcome.php');
    exit();
}

header('location: ../views/home.php');