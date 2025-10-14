<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "webproject";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$con) {
    die("connection failed: ". mysqli_connect_error());
}

