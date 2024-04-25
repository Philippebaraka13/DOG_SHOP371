<?php
session_start();
include 'db.php';

// Security check: Make sure the user is logged in and is an admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Get the list of dogs
$dogList = $conn->query("SELECT * FROM Dogtable");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Dogs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-add-dog.php">Add a Dog</a>
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
    <h1>Manage Dogs</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Breed</th>
            <th scope="col">Sex</th>
            <th scope="col">Age</th>
            <th scope="col">Color</th>
            <th scope="col">Size</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($dog = $dogList->fetch_assoc()): ?>
            <tr>
                <th scope="row"><?php echo $dog['DogID']; ?></th>
                <td><?php echo $dog['DogName']; ?></td>
                <td><?php echo $dog['DogBreed']; ?></td>
                <td><?php echo $dog['DogSex']; ?></td>
                <td><?php echo $dog['DogAge']; ?></td>
                <td><?php echo $dog['DogColor']; ?></td>
                <td><?php echo $dog['DogSize']; ?></td>
                <td><?php echo $dog['DogDescription']; ?></td>
                <td>
                    <a href="admin-edit-dog.php?id=<?php echo $dog['DogID']; ?>" class="btn btn-primary">Edit</a>
                    <a href="admin-delete-dog.php?id=<?php echo $dog['DogID']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
