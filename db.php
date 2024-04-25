<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database connection logic
$host = 'rei.cs.ndsu.nodak.edu'; // or your host
$username = 'seid_ahmed_371s24';
$password = 'sv5L461TYN0!';
$database = 'seid_ahmed_db371s24';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
