<?php
require_once '../functions/database.php';

$username = $_POST['username'];
$password = $_POST['password'];

$db = dbConnect();

$query = pg_query($db, "select * from person where username = '$username' and password = '$password'");

if (pg_num_rows($query) != 1) {
    header('location: ../views/welcome.php');
    exit();
}

header('location: ../views/home.php');