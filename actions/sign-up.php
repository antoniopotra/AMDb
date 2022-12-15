<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/user.php';

$full_name       = $_POST['full-name'];
$username        = $_POST['username'];
$email           = $_POST['email'];
$password        = $_POST['password'];
$repeat_password = $_POST['repeat-password'];

$db = dbConnect();

if (!(isset($full_name) && isset($username) && isset($email) && isset($password) && isset($repeat_password))) {
    $_SESSION['sign-up-error'] = "All fields must be completed.";
    header('location: ../views/welcome.php');
    exit();
}

if ($password != $repeat_password) {
    $_SESSION['sign-up-error'] = "Passwords don't match.";
    header('location: ../views/welcome.php');
    exit();
}

$query = pg_query($db, "select email from person where email = '$email'");
if (pg_num_rows($query) != 0) {
    $_SESSION['sign-up-error'] = "Email already in use.";
    header('location: ../views/welcome.php');
    exit();
}

$query = pg_query($db, "select username from person where username = '$username'");
if (pg_num_rows($query) != 0) {
    $_SESSION['sign-up-error'] = "Username already in use.";
    header('location: ../views/welcome.php');
    exit();
}

addUser($full_name, $username, $email, $password);
header('location: ../views/home.php');