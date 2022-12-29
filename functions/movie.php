<?php
require_once '../functions/database.php';

function moviePoster($movie)
{ ?>
    <a href="../views/movie.php?movie=<?php echo $movie['id']; ?>" draggable="false">
        <img src="<?php echo $movie['poster']; ?>" alt="" draggable="false">
    </a>
<?php }

function getGenres($movieId)
{
    $db = dbConnect();
    $query = pg_query($db, "select g.* from belongs b, genre g where b.genre = g.id and b.movie = $movieId");
    while ($genre = pg_fetch_array($query)) { ?>
        <p>
            <a href="../views/genre-movies.php?genre=<?php echo $genre['id']; ?>" draggable="false">
                <?php echo $genre['name']; ?>
            </a>
        </p>
    <?php }
}

function getCast($movieId)
{
    $db = dbConnect();
    $query = pg_query($db, "select a.* from casting c, actor a where c.movie = $movieId and c.actor = a.id");
    while ($actor = pg_fetch_array($query)) { ?>
        <p>
            <a href="../views/actor-movies.php?actor=<?php echo $actor['id']; ?>" draggable="false">
                <?php echo $actor['name']; ?><b>,</b>
            </a>
        </p>
    <?php }
}