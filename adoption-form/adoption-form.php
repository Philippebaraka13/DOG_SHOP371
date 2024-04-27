<?php
session_start();
include 'header.php';

// Redirect if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Check if a dog ID was passed
$dog_id = $_GET['dog_id'] ?? null;
if ($dog_id === null) {
    echo "Invalid request. No dog specified.";
    exit;
}

// Fetch the dog details from the database
$stmt = $conn->prepare("SELECT DogName, DogBreed FROM Dogtable WHERE DogID = ?");
$stmt->bind_param("i", $dog_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "No such dog found.";
    exit;
}
$dog = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Dog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <link rel="stylesheet" href="styles.css" />
</head>
<body>
<div id ="adoption-form" class="container">
    <h1>Adopt a Dog</h1>
    <h2>Interested in adopting <strong> <?= htmlspecialchars($dog['DogName']) ?></strong>?</h2>
    <p>Breed: <?= htmlspecialchars($dog['DogBreed']) ?></p>
    
    <form id="adoptionForm" method="post">
        <input type="hidden" name="dog_id" value="<?= htmlspecialchars($dog_id) ?>">
        <input type="hidden" name="user_id" value="<?= $_SESSION['userID'] ?>">
        <div class="mb-3">
            <label for="historyNote" class="form-label">Why would you like to adopt this pet?</label>
            <textarea id="historyNote" name="historyNote" required class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Adoption Request</button>

        <div id="adoptionResponse"></div> 
    </form>
</div>
<script src="form-handler.js"></script>

<?php require 'footer.php'; ?>
</body>
</html>
