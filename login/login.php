<?php
// Always start the session at the beginning of the PHP file
session_start();

include 'db.php'; // Ensure db.php path is correct and contains the database connection logic

$logout_message = '';
// Check if the user has just logged out and set a logout message
if (isset($_GET['logged_out']) && $_GET['logged_out'] == 'true') {
    $logout_message = '<div class="alert alert-success" role="alert">You have been logged out successfully.</div>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Modified SQL to select the UserType as well
    $sql = "SELECT UserID, Password, UserType FROM UserTable WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['Password'])) {
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['userID'] = $row['UserID'];
            $_SESSION['username'] = $username;
            $_SESSION['userType'] = $row['UserType'];
            
            // Redirect to the appropriate dashboard based on user type
            if ($_SESSION['userType'] === 'admin') {
                header("Location: admin-dashboard.php");
            } else {
                header("Location: Home.php");
            }
            exit;
        } else {
            $login_error = '<div class="alert alert-danger" role="alert">Invalid password.</div>';
        }
    } else {
        $login_error = '<div class="alert alert-danger" role="alert">Username does not exist.</div>';
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | Animal Adoption Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
                <li class="nav-item">
                    <a class="nav-link" href="register.php">REGISTER</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <!-- Display logout message if set -->
                    <?= $logout_message ?>

                    <!-- Display login error message if set -->
                    <?= $login_error ?? '' ?>

                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer mt-auto py-3 bg-primary text-center">
    <div class="container">
        <span> CSCI-371 Published by: Seid Ahmed & Philippe Baraka ©2024</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
