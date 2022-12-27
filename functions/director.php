<?php
require_once '../functions/database.php';
require_once '../functions/movie.php';

function allDirected($directorId)
{
    $db = dbConnect();
    $query = pg_query($db, "select * from movie where director = $directorId");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}
