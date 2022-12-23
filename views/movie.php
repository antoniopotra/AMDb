<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/database.php';
require_once '../functions/movie.php';
require_once '../functions/review.php';

$db = dbConnect();

$movie_id = $_GET['movie'];
$query = pg_query($db, "select m.* from movie m where m.id = $movie_id");
$movie = pg_fetch_array($query);

$director_id = $movie['director'];
$query = pg_query($db, "select d.* from director d where d.id = $director_id");
$director = pg_fetch_array($query);

$query = pg_query($db, "select count(r), round(avg(r.grade), 2) from review r where r.movie = $movie_id");
$rating = pg_fetch_array($query);

$query = pg_query($db, "select count(w) from watched w where w.movie = $movie_id");
$watch = pg_fetch_array($query);
?>

<div class="movie-container">
    <div class="poster">
        <?php moviePoster($movie); ?>
        <div class="watch-review-info">
            <i class="fa-solid fa-eye fa-2x" style="color: white; cursor: pointer;"></i>
            <i class="fa-solid fa-file-lines fa-2x" style="color: white; cursor: pointer;"></i>
        </div>
    </div>

    <div class="general-info">
        <div class="title">
            <h1> <?php echo $movie['name']; ?> (<?php echo $movie['year']; ?>) </h1>
        </div>

        <div class="director">
            <p class="lighter"> Directed by: </p>
            <p> <?php echo $director['name']; ?> </p>
        </div>

        <div class="average-rating">
            <h2>
                <?php
                if (isset($rating['round'])) {
                    echo $rating['round'];
                } else {
                    echo 0;
                }
                ?>
            </h2>
            <i class="fa-solid fa-star" style="color: var(--orange); transform: translateY(-1px)"></i>
            <h5>(<?php echo $rating['count']; ?> reviews, <?php echo $watch['count']; ?> watches)</h5>
        </div>

        <div class="genre">
            <?php getGenres($movie_id); ?>
        </div>

        <div class="duration">
            <?php echo $movie['duration']; ?>
            <p class="lighter"> min </p>
        </div>

        <div class="casting">
            <p class="lighter"> Casting: </p>
            <?php getCast($movie_id); ?>
        </div>
    </div>
</div>

<div class="user-reviews">
    <h1>My reviews</h1>
    <?php myReviewsForMovie($movie_id); ?>
</div>

<div class="user-reviews">
    <h1>Other reviews</h1>
    <?php otherReviewsForMovie($movie_id); ?>
</div>

<?php include_once '../default/footer.php';