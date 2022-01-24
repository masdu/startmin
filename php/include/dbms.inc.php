<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

$mysqli = new mysqli("127.0.0.1","root", "fulmicotone", "pustok");

if ($mysqli->connect_errno){
    die ("error connecting db ". $mysqli->connect_error);
}

?>