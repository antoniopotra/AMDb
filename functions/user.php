<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/movie.php';

function addUser($full_name, $username, $email, $password)
{
    $db = dbConnect();
    $query = pg_query($db, "insert into person (name, username, email, password) values ('$full_name', '$username', '$email','$password') returning id");
    $person = pg_fetch_array($query);
    return $person['id'];
}

function hasWatched($movie)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select w.* from watched w where w.movie = $movie and w.person = $id");
    if (pg_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function hasReviewed($movie)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.movie = $movie and r.person = $id");
    if (pg_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function addWatchedMovie($movie)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    pg_query($db, "insert into watched (person, movie) values ($id, $movie)");
}

function removeWatchedMovie($movie)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    pg_query($db, "delete from watched w where w.movie = $movie and w.person = $id");
}