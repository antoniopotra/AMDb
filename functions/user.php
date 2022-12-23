<?php
require_once '../functions/database.php';
require_once '../functions/movie.php';

function addUser($full_name, $username, $email, $password)
{
    $db = dbConnect();
    $query = pg_query($db, "insert into person (name, username, email, password) values ('$full_name', '$username', '$email','$password') returning id");
    $person = pg_fetch_array($query);
    return $person['id'];
}
