<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="Home.php"><img src="images/doglogo.jpeg" alt="doglogo" width="80" height="60"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Home.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">CONTACT</a>
                </li>
                <?php if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">REGISTER</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Hello, <?= htmlspecialchars($_SESSION['username']) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">LOGOUT</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <h1 class="text-center mb-4">Welcome To DogShop</h1>
    
    <div class="row">
        <!-- Placeholder for dog images, replace with actual image paths -->
        <div class="col-md-4 mb-3">
            <img src="images/dog1.jpeg" class="img-thumbnail" alt="Dog" />
        </div>
        <div class="col-md-4 mb-3">
            <img src="images/dog2.jpeg" class="img-thumbnail" alt="Dog" />
        </div>
        <div class="col-md-4 mb-3">
            <img src="images/dog3.jpeg" class="img-thumbnail" alt="Dog" />
        </div>
    </div>
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
    <div class="text-center mb-4">
        <p>Explore our diverse range of adorable dogs and find your perfect furry friend today. Begin your journey by browsing our dog list or start your adoption process now.</p>
        <a href="doglist.php" class="btn btn-primary">Dog List</a>
        <a href="adoption-form.php" class="btn btn-secondary">Adoption Form</a>
    </div>
    <?php endif; ?>
</main>

<footer class="footer mt-auto py-3 bg-primary text-center">
    <div class="container">
        <span> CSCI-371 Published by: Seid Ahmed & Philippe Baraka ©2024</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
