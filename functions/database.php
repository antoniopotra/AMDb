<?php
function dbConnect()
{
    static $db;
    if (!$db) {
        $db = pg_connect("host     = localhost
                                         port     = 5432
                                         dbname   = AMDb
                                         user     = postgres
                                         password = postgre@AntonioPotra12");
    }
    return $db;
}