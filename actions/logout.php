<?php
if (!isset($_SESSION)) {
    session_start();
    session_destroy();
}
header('location: ../views/welcome.php');
exit();