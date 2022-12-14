<?php
    require 'env.php';
    require 'functions/db-connect.php';

    $credentials = new Credentials();
    $db = dbConnect($credentials);

    if ($db) {
        header('location: views/welcome.php');
    } else {
        echo "Can't access project database";
    }
