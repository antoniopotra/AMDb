<link href="../public/css/home.css" rel="stylesheet" type="text/css">

<?php
include_once '../default/header.php';

require_once '../default/navbar.php';
require_once '../functions/database.php';

displayNavbar('home');

$db = dbConnect();
?>

<div class="latest-movies">
    <h1>Recently added</h1>
    <div class="image-wrapper">
        <?php
        $query = pg_query($db, "select poster from movie order by id desc limit 10");
        while ($row = pg_fetch_array($query)) { ?>
            <img src="<?php echo $row['poster']; ?>" alt="" style="border: 6px solid var(--white-blue)">
        <?php } ?>
    </div>
</div>

<!-- TODO: select the first 10 movies the user did not watch -->
<!--<div class="recommendations">-->
<!--    <h1>Recommended movies</h1>-->
<!--    <div class="image-wrapper">-->
<!--        --><?php
//        $query = pg_query($db, "select poster from movie order by random() limit 1");
//        while ($row = pg_fetch_array($query)) { ?>
<!--            <img src="--><?php //echo $row['poster']; ?><!--" alt="" style="border: 6px solid var(--white-blue)">-->
<!--        --><?php //} ?>
<!--    </div>-->
<!--</div>-->

<?php
include_once '../default/footer.php';
?>