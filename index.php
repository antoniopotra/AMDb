<?php
require_once 'functions/database.php';

$db = dbConnect();

if ($db) {
    header('location: views/welcome.php');
} else {
    echo "Can't access project database";
}
