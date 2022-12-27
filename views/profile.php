<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/database.php';
require_once '../functions/review.php';
require_once '../functions/user.php';
?>

    <div class="profile-container">
        <div class="user-info">
            <img src="../public/images/user.png" class="user-icon" alt="">

            <?php
            $db = dbConnect();
            $userId = $_GET['user'];
            $query = pg_query($db, "select * from person where id = $userId");
            if (pg_num_rows($query) != 1) {
                echo 'Sorry, this profile does not exist.';
                exit();
            }
            $user = pg_fetch_array($query);
            ?>

            <h2> <?php echo $user['username']; ?> </h2>
        </div>

        <div class="movies-info">
            <div class="watched">
                <?php
                $query = pg_query($db, "select count(m.id) from movie m join watched w on m.id = w.movie join person p on p.id = w.person where p.id = $userId");
                $watched = pg_fetch_array($query);
                ?>

                <h1> <?php echo $watched['count']; ?> </h1>
                <h4><a href="../views/user-movies.php?user=<?php echo $userId; ?>"> movies watched </a></h4>
            </div>

            <div class="reviewed">
                <?php
                $query = pg_query($db, "select count(m.id), round(avg(r.grade), 2) from movie m join review r on m.id = r.movie join person p on p.id = r.person where p.id = $userId");
                $review = pg_fetch_array($query);
                ?>

                <h1> <?php echo $review['count']; ?> </h1>
                <h4> reviews </h4>
            </div>

            <div class="grading">
                <h1> <?php echo $review['round']; ?> </h1>
                <h4><i class="fa-solid fa-star" style="color: var(--orange);"></i> on average </h4>
            </div>
        </div>
    </div>

    <div class="user-movies">
        <h1>Highest rated</h1>
        <div class="image-wrapper">
            <?php highestRated($userId); ?>
        </div>
    </div>

    <div class="user-reviews">
        <h1>Reviews</h1>
        <?php randomReviews($userId); ?>
    </div>

<?php include_once '../default/footer.php'; ?>