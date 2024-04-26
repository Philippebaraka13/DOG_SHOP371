<?php
session_start();
include 'header.php';  // Ensure the header file path is correct

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Prepare user details
$userID = $_SESSION['userID']; // Assuming the user's ID is stored in session

require_once 'db.php'; // Database connection file

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Extract form data
    $dogID = $_POST['dogID'];
    $adoptionStatus = $_POST['adoptionStatus'];
    $historyNote = $_POST['historyNote'];

    // Insert query
    $sql = "INSERT INTO History (AdoptionDate, AdoptionStatus, HistoryNote, Dogtable_DogID, UserTable_UserID) VALUES (NOW(), ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $adoptionStatus, $historyNote, $dogID, $userID);
    if ($stmt->execute()) {
        echo "<p>Request submitted successfully. You will be notified soon.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
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
    <title>Adoption Request Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container">
        <h1>Adoption Request Form</h1>
        <form method="post" action="adoption-request.php">
            <div class="mb-3">
                <label for="dogID" class="form-label">Dog ID:</label>
                <input type="number" class="form-control" id="dogID" name="dogID" required>
            </div>
            <div class="mb-3">
                <label for="adoptionStatus" class="form-label">Adoption Status:</label>
                <select class="form-control" id="adoptionStatus" name="adoptionStatus" required>
                    <option value="pending">Pending</option>
                    <option value="adopted">Adopted</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="historyNote" class="form-label">History Note:</label>
                <textarea class="form-control" id="historyNote" name="historyNote" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
