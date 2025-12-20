<?php
$dbhost = "sql111.byethost13.com";
$dbuser = "b13_40712087";
$dbpass = "Univents112223333";
$dbname = "b13_40712087_Univents";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$con) {
    die("connection failed: " . mysqli_connect_error());
}
