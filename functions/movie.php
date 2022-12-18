<?php
require_once '../functions/database.php';

function loadMoviePoster($movie) { ?>
    <img src="<?php echo $movie['poster']; ?>" alt="">
<?php }

function loadLatestMovies() {
    $db = dbConnect();
    $query = pg_query($db, "select poster from movie order by id desc limit 10");
    while ($row = pg_fetch_array($query)) {
        loadMoviePoster($row);
    }
}
?>
