<?php
session_start();
include 'db.php';  // Include your database connection

// Redirect if not logged in or if the user is not an admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dogName = $_POST['dogName'];
    $dogBreed = $_POST['dogBreed'];
    $dogSex = $_POST['dogSex'];
    $dogAge = $_POST['dogAge'];
    $dogColor = $_POST['dogColor'];
    $dogSize = $_POST['dogSize'];
    $dogDescription = $_POST['dogDescription'];
    $dogMedical = $_POST['dogMedical'];

    // Prepare an insert statement
    $sql = "INSERT INTO Dogtable (DogName, DogBreed, DogSex, DogAge, DogColor, DogSize, DogDescription, DogMedical) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssissss", $dogName, $dogBreed, $dogSex, $dogAge, $dogColor, $dogSize, $dogDescription, $dogMedical);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Dog added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    // Close connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Dog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-manage-dogs.php">Manage Dogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-messages.php">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <h1>Add a New Dog</h1>
        <form action="admin-add-dog.php" method="post">
            <div class="mb-3">
                <label for="dogName" class="form-label">Dog Name</label>
                <input type="text" class="form-control" id="dogName" name="dogName" required>
            </div>
            <div class="mb-3">
                <label for="dogBreed" class="form-label">Dog Breed</label>
                <input type="text" class="form-control" id="dogBreed" name="dogBreed" required>
            </div>
            <div class="mb-3">
                <label for="dogSex" class="form-label">Dog Sex</label>
                <input type="text" class="form-control" id="dogSex" name="dogSex" required>
            </div>
            <div class="mb-3">
                <label for="dogAge" class="form-label">Dog Age</label>
                <input type="text" class="form-control" id="dogAge" name="dogAge" required>
            </div>
            <div class="mb-3">
                <label for="dogColor" class="form-label">Dog Color</label>
                <input type="text" class="form-control" id="dogColor" name="dogColor" required>
            </div>
            <div class="mb-3">
                <label for="dogSize" class="form-label">Dog Size</label>
                <input type="text" class="form-control" id="dogSize" name="dogSize" required>
            </div>
            <div class="mb-3">
                <label for="dogDescription" class="form-label">Dog Description</label>
                <input type="text" class="form-control" id="dogDescription" name="dogDescription" required>
            </div>
            <div class="mb-3">
                <label for="dogMedical" class="form-label">Dog Medical</label>
                <input type="text" class="form-control" id="dogMedical" name="dogMedical" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Dog</button>
        </form>
    </div>
    <!-- Include Bootstrap JS and any other scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
