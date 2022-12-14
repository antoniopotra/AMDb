<?php
    function dbConnect(Credentials $credentials) {
        return pg_connect("host = '$credentials->host'
                                          port = '$credentials->port'
                                          dbname = '$credentials->dbname'
                                          user = '$credentials->user'
                                          password = '$credentials->password'");
    }