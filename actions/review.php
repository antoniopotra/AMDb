<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../views/welcome.php');
    exit();
}

require_once '../functions/database.php';
require_once '../functions/user.php';

$userId = $_SESSION['user'];
$movieId = $_GET['movie'];
$content = $_POST['content'];
$grade = $_POST['grade'];

if ($grade == "") {
    $_SESSION['review-error'] = 'Grade is mandatory.';
    header('location: ../views/movie.php?movie=' . $movieId);
    exit();
}

if (!(is_numeric($grade) and $grade >= 1 and $grade <= 10)) {
    $_SESSION['review-error'] = 'Grade must be a number between 1 and 10.';
    header('location: ../views/movie.php?movie=' . $movieId);
    exit();
}

$db = dbConnect();
$query = pg_query($db, "select * from review where movie = $movieId and person = $userId");
if (pg_num_rows($query) == 0) {
    pg_query($db, "insert into review (person, movie, content, grade) values ($userId, $movieId, '$content', $grade)");
} else {
    if ($content != "") {
        pg_query($db, "update review set content = '$content', grade = $grade where movie = $movieId and person = $userId");
    } else {
        pg_query($db, "update review set grade = $grade where movie = $movieId and person = $userId");
    }
}
if (!hasWatched($movieId)) {
    pg_query($db, "insert into watched (person, movie) values ($userId, $movieId)");
}
header('location: ../views/movie.php?movie=' . $movieId);