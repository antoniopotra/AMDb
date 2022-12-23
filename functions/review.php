<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/movie.php';

function reviewCard($movie, $review) { ?>
    <div class="review-card">
        <h2> <?php echo $movie['name']; ?> (<?php echo $movie['year']; ?>) </h2> <br>
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i> </h3>
    </div>
<?php
}

function reviewCardMe($review) { ?>
    <div class="review-card">
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i> </h3>
    </div>
    <?php
}

function reviewCardOther($review, $user) { ?>
    <div class="review-card">
        <h2> <?php echo $user['username']; ?> </h2> <br>
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i> </h3>
    </div>
    <?php
}

function latestReviews() {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.person = $id limit 10");
    while ($review = pg_fetch_array($query)) {
        $movie_id = $review['movie'];
        $movie_query = pg_query($db, "select m.name, m.year from movie m where m.id = $movie_id");
        $movie = pg_fetch_array($movie_query);
        reviewCard($movie, $review);
    }
}

function myReviewsForMovie($movie) {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.person = $id and r.movie = $movie");
    while ($review = pg_fetch_array($query)) {
        reviewCardMe($review);
    }
}

function otherReviewsForMovie($movie) {
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.movie = $movie and r.person != $id");
    while ($review = pg_fetch_array($query)) {
        $user_id = $review['person'];
        $user_query = pg_query($db, "select p.username from person p where p.id = $user_id");
        $user = pg_fetch_array($user_query);
        reviewCardOther($review, $user);
    }
}
