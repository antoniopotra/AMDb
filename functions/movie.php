<?php
require_once '../functions/database.php';

function moviePoster($movie)
{ ?>
    <a href="../views/movie.php?movie=<?php echo $movie['id']; ?>" draggable="false">
        <img src="<?php echo $movie['poster']; ?>" alt="" draggable="false">
    </a>
<?php }

function latestMovies()
{
    $db = dbConnect();
    $query = pg_query($db, "select poster, id from movie order by id desc limit 10");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}

function getGenres($movieId)
{
    $db = dbConnect();
    $query = pg_query($db, "select g.name from belongs b, genre g where b.genre = g.id and b.movie = $movieId");
    while ($genre = pg_fetch_array($query)) { ?>
        <p> <?php echo $genre['name']; ?> </p>
    <?php }
}

function getCast($movieId)
{
    $db = dbConnect();
    $query = pg_query($db, "select a.name from casting c, actor a where c.movie = $movieId and c.actor = a.id");
    while ($actor = pg_fetch_array($query)) { ?>
        <p> <?php echo $actor['name']; ?><b>,</b></p>
    <?php }
}