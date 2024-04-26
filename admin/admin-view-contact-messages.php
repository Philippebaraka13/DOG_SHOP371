<?php
// Start the session
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Include the header
include 'header.php';

// Include database connection
require_once 'db.php';

// Fetch all messages
$sql = "SELECT * FROM ContactMessages ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Messages | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="container mt-4">
    <h1>Admin - View Messages</h1>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Submitted At</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($row['id']) ?></th>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= htmlspecialchars($row['submitted_at']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</main>

<?php
// Include the footer
include 'footer.php';
mysqli_close($conn);
?>

</body>
</html>
