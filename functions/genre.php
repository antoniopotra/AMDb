<?php
require_once '../functions/movie.php';

function allBelonging($genreId)
{
    $db = dbConnect();
    $query = pg_query($db, "select m.* from belongs b, movie m where b.genre = $genreId and b.movie = m.id");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}
