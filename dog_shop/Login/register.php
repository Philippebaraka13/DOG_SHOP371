<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <?php
                    include 'db.php';  // Ensure db.php path is correct
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $username = $_POST['username'];
                        $firstName = $_POST['firstName'];
                        $lastName = $_POST['lastName'];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $userType = $_POST['userType'];  // Capture user type from form
                        $annualIncome = $_POST['annualIncome'];
                        $numberOfPets = $_POST['numberOfPets'];

                        $sql = "INSERT INTO UserTable (Username, FirstName, LastName, Password, Email, Address, UserType, AnnualIncome, NumberOfPetsAtHome) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssssssii", $username, $firstName, $lastName, $password, $email, $address, $userType, $annualIncome, $numberOfPets);
                        $stmt->execute();

                        if ($stmt->affected_rows > 0) {
                            $stmt->close();
                            header("Location: login.php"); // Redirect to login page
                            exit;
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
                        }
                        $stmt->close();
                        $conn->close();
                    }
                    ?>

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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
