<?php
$server = "localhost";
$username = "comp440";
$password = "pass1234";
$db = "comp440";

// Create connection
$conn = mysqli_connect($server, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";
