<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database connection logic
$host = 'rei.cs.ndsu.nodak.edu'; // or your host
$username = 'philippe_baraka_371s24';
$password = '3KF2Jj2FvN0!';
$database = 'philippe_baraka_db371s24';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
