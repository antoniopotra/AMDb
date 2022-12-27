<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/home.php');
    exit();
}

include_once '../default/header.php';
include_once '../default/navbar.php';

require_once '../functions/database.php';
?>

    <table class="search-container">
        <tr>
            <td class="search-criteria">
                <ul>
                    <li><a href="../views/movie-search.php" draggable="false" class="lighter">Movie</a></li>
                    <li><a href="../views/director-search.php" draggable="false" class="lighter">Director</a></li>
                    <li><a href="../views/actor-search.php" draggable="false" class="lighter">Actor</a></li>
                    <li><a href="../views/genre-search.php" draggable="false" class="lighter selected">Genre</a></li>
                </ul>
            </td>
            <td class="search-results column">
                <?php
                $db = dbConnect();
                $search = $_SESSION['search'];
                $query = pg_query($db, "select * from genre where upper(name) like '%$search%'");
                while ($genre = pg_fetch_array($query)) { ?>
                    <a href="../views/director-movies.php?director=<?php echo $genre['id']; ?>" draggable="false">
                        <p><?php echo $genre['name']; ?></p>
                    </a>
                <?php }
                ?>
            </td>
        </tr>
    </table>

<?php include_once '../default/footer.php'; ?>