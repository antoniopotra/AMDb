<?php
require_once '../functions/database.php';

function addUser($full_name, $username, $email, $password) {
    pg_query(dbConnect(), "insert into person (name, username, email, password) values ('$full_name', '$username', '$email','$password')");
}