<link href="../public/css/profile.css" type="text/css" rel="stylesheet">

<?php
session_start();

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/database.php';
?>

<div class="container">
    <div class="user-info">
        <img src="../public/images/user.png" class="user-icon" alt="">

        <?php
        $db = dbConnect();
        $id = $_SESSION['user'];
        $query = pg_query($db, "select * from person where id = $id");
        $row = pg_fetch_array($query);
        ?>

        <h2> <?php echo $row['username']; ?> </h2>
    </div>

    <div class="movies-info">
        <div class="watched">
            <?php
            $query = pg_query($db, "select count(m.id) from movie m join watched w on m.id = w.movie join person p on p.id = w.person where p.id = $id");
            $row = pg_fetch_array($query);
            ?>

            <h1> <?php echo $row['count']; ?> </h1>
            <h4> movies watched </h4>
        </div>

        <div class="reviewed">
            <?php
            $query = pg_query($db, "select count(m.id) from movie m join review r on m.id = r.movie join person p on p.id = r.person where p.id = $id");
            $row = pg_fetch_array($query);
            ?>

            <h1> <?php echo $row['count']; ?> </h1>
            <h4> reviews </h4>
        </div>
    </div>
</div>

<div class="user-reviews">
    <h1>Reviews</h1>

    <div class="review-card">some movie info</div>
    <div class="review-card">some movie info</div>
    <div class="review-card">some movie info</div>
    <div class="review-card">some movie info</div>
    <div class="review-card">some movie info</div>
    <div class="review-card">some movie info</div>
</div>
