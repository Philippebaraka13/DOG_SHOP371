<?php
session_start();
session_unset();
session_destroy();

// Redirect to the login page with a logout parameter
header('Location: Home.php');
exit;
?>

