<?php
// Start the session
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Include database connection file
require 'db.php';

// Prepare the query
$query = "SELECT * FROM Dogtable";

// If there's a search term, adjust the query
$searchTerm = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $conn->real_escape_string($_GET['search']);
    $query .= " WHERE DogBreed LIKE '%$searchTerm%' OR DogDescription LIKE '%$searchTerm%'";
}

// Initialize an array to store the dogs
$dogs = [];

// Execute the query
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $dogs[] = $row;
    }
    // Free result set
    $result->free();
}

// Close connection
$conn->close();

// Include the header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog List | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="container mt-4">
    <h1 class="text-center mb-4">Meet Our Dogs</h1>
    <div class="mb-4">
        <form action="doglist.php" method="get">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by breed or description..." value="<?= htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="row">
        <?php foreach ($dogs as $dog): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <?php
                    $imgPath = "images/" . htmlspecialchars($dog['DogID']) . ".jpg";
                    if (!file_exists($imgPath)) {
                        $imgPath = "images/default-placeholder.png"; // Ensure you have a default placeholder image
                    }
                    ?>
                    <img src="<?= $imgPath ?>" alt="Image of <?= htmlspecialchars($dog['DogName']); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($dog['DogName']); ?></h5>
                        <p class="card-text">Breed: <?= htmlspecialchars($dog['DogBreed']); ?></p>
                        <a href="dog-detail.php?id=<?= $dog['DogID']; ?>" class="btn btn-primary" target="_blank">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php
// Include the footer
include 'footer.php';
?>

</body>
</html>
