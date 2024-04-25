<?php
session_start();
include 'db.php';

// Security check: Make sure the user is logged in and is an admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Get the list of messages
$messageList = $conn->query("SELECT * FROM MessageTabel");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-manage-dogs.php">Manage Dogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-add-dog.php">Add dog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
<div class="container mt-4">
    <h1>Messages</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Date</th>
            <th scope="col">Email</th>
            <th scope="col">Message</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($message = $messageList->fetch_assoc()): ?>
            <tr>
                <th scope="row"><?php echo $message['MessageID']; ?></th>
                <td><?php echo $message['UserName']; ?></td>
                <td><?php echo $message['MessageDate']; ?></td>
                <td><?php echo $message['MessageEmail']; ?></td>
                <td><?php echo $message['MessageText']; ?></td>
                <td>
                    <!-- Here you could add a link to a message reply page -->
                    <a href="admin-delete-message.php?id=<?php echo $message['MessageID']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
