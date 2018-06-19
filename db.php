<?php
$servername = "localhost";
$username = "app";
$password = "8y8479xs4L24qwsw";
$database = "appdata";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);
$mysqli->set_charset("utf8");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
