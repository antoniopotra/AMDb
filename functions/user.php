<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/movie.php';

function addUser($full_name, $username, $email, $password) {
    $db = dbConnect();
    $query = pg_query($db, "insert into person (name, username, email, password) values ('$full_name', '$username', '$email','$password') returning id");
    $row = pg_fetch_array($query);
    return $row['id'];
}

function loadUserRecommendations() {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select m1.poster from movie m1 where m1.id not in (select m.id from movie m join watched w on m.id = w.movie join person p on p.id = w.person where p.id = $id) order by random() limit 10");
    while ($row = pg_fetch_array($query)) {
        loadMoviePoster($row);
    }
}
