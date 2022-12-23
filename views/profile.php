<link href="../public/css/profile.css" type="text/css" rel="stylesheet">

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
?>

<div class="container">
    <div class="user-info">
        <img src="../public/images/user.png" class="user-icon" alt="">

        <?php
        $db = dbConnect();
        $id = $_SESSION['user'];
        $query = pg_query($db, "select * from person where id = $id");
        $person = pg_fetch_array($query);
        ?>

        <h2> <?php echo $person['username']; ?> </h2>
    </div>

    <div class="movies-info">
        <div class="watched">
            <?php
            $query = pg_query($db, "select count(m.id) from movie m join watched w on m.id = w.movie join person p on p.id = w.person where p.id = $id");
            $watched = pg_fetch_array($query);
            ?>

            <h1> <?php echo $watched['count']; ?> </h1>
            <h4> <a href="../views/my-movies.php"> movies watched </a> </h4>
        </div>

        <div class="reviewed">
            <?php
            $query = pg_query($db, "select count(m.id), round(avg(r.grade), 2) from movie m join review r on m.id = r.movie join person p on p.id = r.person where p.id = $id");
            $review = pg_fetch_array($query);
            ?>

            <h1> <?php echo $review['count']; ?> </h1>
            <h4> reviews </h4>
        </div>

        <div class="grading">
            <h1> <?php echo $review['round']; ?> </h1>
            <h4> <i class="fa-solid fa-star" style="color: var(--orange);"></i> on average </h4>
        </div>
    </div>
</div>

<div class="user-movies">
    <h1>Recently watched</h1>
    <div class="image-wrapper">
        <?php recentlyWatched(); ?>
    </div>
</div>

<div class="user-reviews">
    <h1>Latest reviews</h1>
    <?php latestReviews(); ?>
</div>

<?php include_once '../default/footer.php'; ?>