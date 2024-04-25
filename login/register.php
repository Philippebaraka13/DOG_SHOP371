<?php
// Start the session
session_start();
include 'db.php';  // Make sure db.php path is correct and contains the database connection logic

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $address = $_POST['address'];
    $userType = $_POST['userType'];
    $annualIncome = $_POST['annualIncome'];
    $numberOfPets = $_POST['numberOfPets'];

    $sql = "INSERT INTO UserTable (Username, FirstName, LastName, Password, Email, Address, UserType, AnnualIncome, NumberOfPetsAtHome) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssii", $username, $firstName, $lastName, $password, $email, $address, $userType, $annualIncome, $numberOfPets);
    if ($stmt->execute()) {
        header("Location: login.php"); // Redirect to login page
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">Registration failed: ' . $stmt->error . '</div>';
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form | Animal Adoption Center</title>
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
                    <a class="nav-link" href="login.php">LOGIN</a>
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
                    <h3 class="text-center">Registration</h3> 
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="userType">User Type</label>
                            <select class="form-control" id="userType" name="userType">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="annualIncome">Annual Income</label>
                            <input type="number" class="form-control" id="annualIncome" name="annualIncome">
                        </div>
                        <div class="form-group">
                            <label for="numberOfPets">Number of Pets at Home</label>
                            <input type="number" class="form-control" id="numberOfPets" name="numberOfPets">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
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
