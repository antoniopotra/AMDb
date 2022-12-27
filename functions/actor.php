<?php
require_once '../functions/database.php';
require_once '../functions/movie.php';

function allStarring($actorId)
{
    $db = dbConnect();
    $query = pg_query($db, "select m.* from casting c, movie m where m.id = c.movie and c.actor = $actorId");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}
