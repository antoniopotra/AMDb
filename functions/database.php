<?php
function dbConnect()
{
    static $db;
    if (!$db) {
        $db = pg_connect("host     = localhost
                                         port     = 5432
                                         dbname   = AMDb
                                         user     = postgres
                                         password = postgre@AntonioPotra12");
    }
    return $db;
}

function latestMovies()
{
    $db = dbConnect();
    $query = pg_query($db, "select * from movie order by id desc limit 10");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}