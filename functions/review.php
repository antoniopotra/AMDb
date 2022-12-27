<?php
session_start();

require_once '../functions/database.php';
require_once '../functions/movie.php';

function reviewCardMovie($movie, $review)
{ ?>
    <div class="review-card">
        <a href="../views/movie.php?movie=<?php echo $movie['id']; ?>" draggable="false">
            <h2> <?php echo $movie['name']; ?> (<?php echo $movie['year']; ?>) </h2> <br>
        </a>
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i></h3>
    </div>
    <?php
}

function reviewCardUser($user, $review)
{ ?>
    <div class="review-card">
        <a href="../views/profile.php?user=<?php echo $user['id']; ?>">
            <h2> <?php echo $user['username']; ?> </h2> <br>
        </a>
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i></h3>
    </div>
    <?php
}

function reviewCardNoMovieNoUser($review)
{ ?>
    <div class="review-card">
        <h4> <?php echo $review['content']; ?> </h4> <br>
        <h3> <?php echo $review['grade']; ?> <i class="fa-solid fa-star" style="color: var(--orange);"></i></h3>
    </div>
    <?php
}

function randomReviews($userId)
{
    $db = dbConnect();
    $query = pg_query($db, "select r.* from review r where r.person = $userId order by random() limit 10");
    while ($review = pg_fetch_array($query)) {
        $movieId = $review['movie'];
        $movieQuery = pg_query($db, "select m.* from movie m where m.id = $movieId");
        $movie = pg_fetch_array($movieQuery);
        reviewCardMovie($movie, $review);
    }
}

function loggedUserReviewForMovie($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.person = $id and r.movie = $movieId");
    while ($review = pg_fetch_array($query)) {
        reviewCardNoMovieNoUser($review);
    }
}

function otherUserReviewsForMovie($movieId)
{
    $db = dbConnect();
    $id = $_SESSION['user'];
    $query = pg_query($db, "select r.* from review r where r.movie = $movieId and r.person != $id");
    while ($review = pg_fetch_array($query)) {
        $userId = $review['person'];
        $userQuery = pg_query($db, "select p.* from person p where p.id = $userId");
        $user = pg_fetch_array($userQuery);
        reviewCardUser($user, $review);
    }
}