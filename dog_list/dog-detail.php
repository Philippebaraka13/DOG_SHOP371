<?php
// Start the session
session_start();

// Include database connection file
require 'db.php';

// Get the DogID from the URL
$dogID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Prepare the query to fetch the dog details
$query = "SELECT * FROM Dogtable WHERE DogID = ?";

// Prepare and execute the statement
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $dogID);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the dog data
$dog = $result->fetch_assoc();

// Close the statement and the connection
$stmt->close();
$conn->close();

// Include the header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($dog['DogName']); ?> Details | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="container mt-4">
    <h1><?= htmlspecialchars($dog['DogName']); ?> - Details</h1>
    <div class="card">
        <img src="images/<?= htmlspecialchars($dog['DogID']); ?>.jpg" alt="<?= htmlspecialchars($dog['DogName']); ?>" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($dog['DogName']); ?></h5>
            <p class="card-text"><strong>Breed:</strong> <?= htmlspecialchars($dog['DogBreed']); ?></p>
            <p class="card-text"><strong>Description:</strong> <?= htmlspecialchars($dog['DogDescription']); ?></p>
            <!-- Add more fields as necessary -->
        </div>
    </div>
</main>

<?php
// Include the footer
include 'footer.php';
?>

</body>
</html>
