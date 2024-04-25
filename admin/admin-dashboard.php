<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Animal Adoption Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="admin-styles.css" /> <!-- Ensure this points to your CSS file with the above changes -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="Home.php"><img src="images/doglogo.jpeg" alt="doglogo" width="80" height="60">Admin Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
</nav>
    
<main class="container mt-4">
    <h1 class="text-center mb-4">Welcome, Admin</h1>
    <!-- Admin functionalities could be listed here -->
</main>
    
<footer class="footer mt-auto py-3 bg-primary text-center">
    <div class="container">
        <span> CSCI-371 Published by: Seid Ahmed & Philippe Baraka ©2024</span>
    </div>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
