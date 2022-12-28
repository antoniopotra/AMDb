<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/review.php';
require_once '../functions/user.php';

$db = dbConnect();

$movieId = $_GET['movie'];
$query = pg_query($db, "select m.* from movie m where m.id = $movieId");
$movie = pg_fetch_array($query);

$directorId = $movie['director'];
$query = pg_query($db, "select d.* from director d where d.id = $directorId");
$director = pg_fetch_array($query);

$query = pg_query($db, "select count(r), round(avg(r.grade), 2) from review r where r.movie = $movieId");
$rating = pg_fetch_array($query);

$query = pg_query($db, "select count(w) from watched w where w.movie = $movieId");
$watch = pg_fetch_array($query);
?>

    <div id="movie-container">
        <div class="movie-container">
            <div class="poster">
                <?php moviePoster($movie); ?>
                <div class="watch-review-info">
                    <?php if (hasWatched($movieId)) { ?>
                        <i class="fa-solid fa-eye fa-2x" style="color: var(--orange); cursor: pointer;" id="watch"
                           role="button" onclick="requestRemoveWatchedMovie(<?php echo $movieId ?>)"></i>
                    <?php } else { ?>
                        <i class="fa-solid fa-eye fa-2x" style="color: white; cursor: pointer;" id="watch" role="button"
                           onclick="requestAddWatchedMovie(<?php echo $movieId ?>)"></i>
                    <?php } ?>

                    <?php if (hasReviewed($movieId)) { ?>
                        <i class="fa-solid fa-file-lines fa-2x" style="color: var(--orange); cursor: pointer;"
                           id="review" role="button" onclick="openReviewWindow()"></i>
                    <?php } else { ?>
                        <i class="fa-solid fa-file-lines fa-2x" style="color: white; cursor: pointer;" id="review"
                           role="button" onclick="openReviewWindow()"></i>
                    <?php } ?>
                </div>
            </div>

            <div class="general-info">
                <div class="title">
                    <h1> <?php echo $movie['name']; ?> (<?php echo $movie['year']; ?>) </h1>
                </div>

                <div class="director">
                    <p class="lighter"> Directed by: </p>
                    <p>
                        <a href="../views/director-movies.php?director=<?php echo $directorId; ?>">
                            <?php echo $director['name']; ?>
                        </a>
                    </p>
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
                    <?php getGenres($movieId); ?>
                </div>

                <div class="duration">
                    <?php echo $movie['duration']; ?>
                    <p class="lighter"> min </p>
                </div>

                <div class="casting">
                    <p class="lighter"> Casting: </p>
                    <?php getCast($movieId); ?>
                </div>
            </div>
        </div>

        <div class="user-reviews">
            <h1>My review</h1>
            <?php loggedUserReviewForMovie($movieId); ?>
        </div>

        <div class="user-reviews">
            <h1>Other reviews</h1>
            <?php otherUserReviewsForMovie($movieId); ?>
        </div>
    </div>

    <div class="form-popup" id="review-form">
        <form action="../actions/review.php?movie=<?php echo $movieId; ?>" method="post">
            <h2><?php echo $movie['name']; ?> (<?php echo $movie['year']; ?>)</h2>

            <?php $review = getReview($movieId); ?>
            <div class="input-container">
                <input name="content" type="text" id="content" placeholder="Content"
                       value="<?php echo $review['content']; ?>">
                <label for="content">Content</label>
            </div>

            <div class="input-container">
                <input name="grade" type="number" id="grade" placeholder="Grade" step="0.01" min="1" max="10" required
                       value="<?php echo $review['grade']; ?>">
                <label for="grade">Grade</label>
            </div>

            <h6>
                <?php
                echo $_SESSION['review-error'];
                $_SESSION['review-error'] = "";
                ?>
            </h6>

            <input type="submit" class="btn" id="submit">
            <label for="submit"></label>

            <input onclick="closeReviewWindow()" class="btn" value="Close" id="close">
            <label for="close"></label>
        </form>
    </div>

<?php include_once '../default/footer.php';