<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/home.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/movie.php';
?>

    <table class="search-container">
        <tr>
            <td class="search-criteria">
                <ul>
                    <li><a href="../views/movie-search.php" draggable="false" class="lighter selected">Movie</a></li>
                    <li><a href="../views/director-search.php" draggable="false" class="lighter">Director</a></li>
                    <li><a href="../views/actor-search.php" draggable="false" class="lighter">Actor</a></li>
                    <li><a href="../views/genre-search.php" draggable="false" class="lighter">Genre</a></li>
                </ul>
            </td>
            <td class="search-results">
                <?php
                $db = dbConnect();
                $search = $_SESSION['search'];
                $query = pg_query($db, "select * from movie where upper(name) like '%$search%'");
                while ($movie = pg_fetch_array($query)) {
                    moviePoster($movie);
                }
                ?>
            </td>
        </tr>
    </table>

<?php include_once '../default/footer.php'; ?>