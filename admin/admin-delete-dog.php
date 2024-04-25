<?php
session_start();
include 'db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Dogtable WHERE DogID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: admin-manage-dogs.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: admin-manage-dogs.php");
    exit;
}
