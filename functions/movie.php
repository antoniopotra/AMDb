<?php
session_start();

require_once '../functions/database.php';

function loadMoviePoster($movie) { ?>
    <img src="<?php echo $movie['poster']; ?>" alt="">
<?php }

function loadLatestMovies() {
    $db = dbConnect();
    $query = pg_query($db, "select poster from movie order by id desc limit 10");
    while ($movie = pg_fetch_array($query)) {
        loadMoviePoster($movie);
    }
}

function loadRecommendations() {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select m1.poster from movie m1 where m1.id not in (select m.id from movie m join watched w on m.id = w.movie join person p on p.id = w.person where p.id = $id) order by random() limit 10");
    while ($movie = pg_fetch_array($query)) {
        loadMoviePoster($movie);
    }
}

function loadAllWatched() {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select m.poster from movie m join watched w on m.id = w.movie join person p on p.id = w.person where p.id = $id");
    while ($movie = pg_fetch_array($query)) {
        loadMoviePoster($movie);
    }
}