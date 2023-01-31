<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once '../functions/movie.php';

function addUser($fullName, $username, $email, $password)
{
    $db = dbConnect();
    $query = pg_query($db, "insert into person (name, username, email, password) values ('$fullName', '$username', '$email', crypt('$password', gen_salt('bf'))) returning id");
    $user = pg_fetch_array($query);
    return $user['id'];
}

function hasWatched($movieId)
{
    $db = dbConnect();
    $userId = $_SESSION['user'];
    $query = pg_query($db, "select w.* from watched w where w.movie = $movieId and w.person = $userId");
    if (pg_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function hasReviewed($movieId)
{
    $db = dbConnect();
    $userId = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.movie = $movieId and r.person = $userId");
    if (pg_num_rows($query) > 0) {
        return true;
    }
    return false;
}

function addWatchedMovie($movieId)
{
    $db = dbConnect();
    $userId = $_SESSION['user'];
    pg_query($db, "insert into watched (person, movie) values ($userId, $movieId)");
}

function removeWatchedMovie($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    pg_query($db, "delete from watched w where w.movie = $movieId and w.person = $id");
}

function recommendations()
{
    $db = dbConnect();
    $userId = $_SESSION['user'];
    $query = pg_query($db, "select m1.poster, m1.id from movie m1 where m1.id not in (select m.id from movie m, watched w where m.id = w.movie and w.person = $userId) order by random() limit 10");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}

function highestRated($userId)
{
    $db = dbConnect();
    $query = pg_query($db, "select m.poster, m.id from movie m, review r where r.person = $userId and r.movie = m.id order by r.grade desc limit 10");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}

function allWatched($userId)
{
    $db = dbConnect();
    $query = pg_query($db, "select m.poster, m.id from movie m, watched w where m.id = w.movie and w.person = $userId order by m.name");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}