<?php
// Always start by securing the session.
session_start();

// Redirect if not logged in or if the user is not an admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Animal Adoption Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Include your own stylesheet for admin-specific styles -->
    <link rel="stylesheet" href="admin-styles.css" />
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-add-dog.php">Add a Dog</a>
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
    
    <!-- Main content -->
    <main class="container mt-4">
        <h1 class="text-center mb-4">Welcome, Admin</h1>
        <!-- Admin functionalities could be listed here -->
    </main>
    
    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-primary text-center">
        <div class="container">
            <span>©2024 Animal Adoption Center. Admin Panel.</span>
        </div>
    </footer>
    
    <!-- Bootstrap's JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
