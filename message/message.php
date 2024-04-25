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

// Get the logged-in user's ID and username from the session
$userId = $_SESSION['userID']; // Ensure 'userID' matches your session variable
$username = $_SESSION['username'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $messageText = $_POST['message'] ?? '';
    $currentDate = date('Y-m-d'); // Current date

    // Insert the message into the database
    $stmt = $conn->prepare("INSERT INTO MessageTabel (UserID, UserName, MessageDate, MessageEmail, MessageText, UserTable_UserID) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $userId, $username, $currentDate, $email, $messageText, $userId);
    $stmt->execute();
    $stmt->close();
}

// Retrieve all messages for the current user
$messages = [];
$stmt = $conn->prepare("SELECT * FROM MessageTabel WHERE UserID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

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
    <title>Messages | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="container mt-4">
    <h2>Submit a New Message</h2>
    <form method="post" action="message.php">
        <!-- Form fields here -->
        
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>

    <h3 class="mt-4">List of Your Messages</h3>
    <!-- Messages list here -->
       <ul class="list-group">
        <?php foreach ($messages as $msg): ?>
            <li class="list-group-item">
                <strong>Date:</strong> <?= htmlspecialchars($msg['MessageDate']); ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($msg['MessageEmail']); ?><br>
                <strong>Message:</strong> <?= htmlspecialchars($msg['MessageText']); ?>
            </li>
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <!-- Other navigation items -->
    <li class="nav-item">
        <a class="nav-link" href="message.php">Messages</a>
    </li>
    <!-- Other navigation items -->
</nav>

        <?php endforeach; ?>
    </ul>
</main>

<?php
// Include the footer
include 'footer.php';
?>

</body>
</html>
