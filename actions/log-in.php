<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once '../functions/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    $_SESSION['log-in-error'] = "All fields must be completed.";
    header('location: ../views/welcome.php');
    exit();
}

$db = dbConnect();

$query = pg_query($db, "select username, password from person where username = '$username'");
if (pg_num_rows($query) != 1) {
    $_SESSION['log-in-error'] = "Username doesn't exist.";
    header('location: ../views/welcome.php');
    exit();
}

$encryptedPassword = pg_fetch_array($query)['password'];
$query = pg_query($db, "select id, password from person where username = '$username' and password = crypt('$password', '$encryptedPassword')");
if (pg_num_rows($query) != 1) {
    $_SESSION['log-in-error'] = "Incorrect password.";
    header('location: ../views/welcome.php');
    exit();
}

$row = pg_fetch_array($query);
$_SESSION['user'] = $row['id'];
header('location: ../views/home.php');