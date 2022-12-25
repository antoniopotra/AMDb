<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/movie.php';

function addUser($fullName, $username, $email, $password)
{
    $db = dbConnect();
    $query = pg_query($db, "insert into person (name, username, email, password) values ('$fullName', '$username', '$email','$password') returning id");
    $person = pg_fetch_array($query);
    return $person['id'];
}

function hasWatched($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select w.* from watched w where w.movie = $movieId and w.person = $id");
    if (pg_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function hasReviewed($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.movie = $movieId and r.person = $id");
    if (pg_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function addWatchedMovie($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    pg_query($db, "insert into watched (person, movie) values ($id, $movieId)");
}

function removeWatchedMovie($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    pg_query($db, "delete from watched w where w.movie = $movieId and w.person = $id");
}

function getReview($movieId)
{
    $db = dbConnect();
    $userId = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.movie = $movieId and r.person = $userId");
    return pg_fetch_array($query);
}