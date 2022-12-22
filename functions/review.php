<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/movie.php';

function loadReviewCard($movie, $review) { ?>
    <div class="review-card">
        <h2> <?php echo $movie['name']; ?> (<?php echo $movie['year']; ?>) </h2> <br>
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i> </h3>
    </div>
<?php
}

function loadAllReviews() {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.movie, r.content, r.grade from review r join person p on p.id = r.person where p.id = $id order by random()");
    while ($review = pg_fetch_array($query)) {
        $movie_id = $review['movie'];
        $movie_query = pg_query($db, "select m.name, m.year from movie m where m.id = $movie_id");
        $movie = pg_fetch_array($movie_query);
        loadReviewCard($movie, $review);
    }
}
