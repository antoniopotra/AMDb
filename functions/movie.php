<?php
session_start();

require_once '../functions/database.php';

function moviePoster($movie)
{ ?>
    <a href="../views/movie.php?movie=<?php echo $movie['id']; ?>" draggable="false">
        <img src="<?php echo $movie['poster']; ?>" alt="" role="button" draggable="false">
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

function recommendations()
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select m1.poster, m1.id from movie m1 where m1.id not in (select m.id from movie m, watched w where m.id = w.movie and w.person = $id) order by random() limit 10");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}

function recentlyWatched()
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select m.poster, m.id from movie m, watched w where m.id = w.movie and w.person = $id limit 10");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}

function allWatched()
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select m.poster, m.id from movie m, watched w where m.id = w.movie and w.person = $id");
    while ($movie = pg_fetch_array($query)) {
        moviePoster($movie);
    }
}

function getGenres($movie)
{
    $db = dbConnect();
    $query = pg_query($db, "select g.name from belongs b, genre g where b.genre = g.id and b.movie = $movie");
    while ($genre = pg_fetch_array($query)) { ?>
        <p> <?php echo $genre['name']; ?> </p>
    <?php }
}

function getCast($movie)
{
    $db = dbConnect();
    $query = pg_query($db, "select a.name from casting c, actor a where c.movie = $movie and c.actor = a.id");
    while ($actor = pg_fetch_array($query)) { ?>
        <p> <?php echo $actor['name']; ?><b>,</b></p>
    <?php }
}