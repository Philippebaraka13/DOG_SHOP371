<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db.php';
if (!isset($_GET['dog_id'])) {
    header('Location: dashboard.php');
    exit;
}
$dog_id = $_GET['dog_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Dog</title>
</head>
<body>
    <?php
echo "Debug - Dog ID: $dog_id, User ID: " . $_SESSION['userID'];
?>

    <div class="container">
        <h1>Adoption Request</h1>
        <form action="submit_adoption.php" method="post">
            <input type="hidden" name="dog_id" value="<?= $dog_id ?>">
            <input type="hidden" name="user_id" value="<?= $_SESSION['userID'] ?>">
            <div class="mb-3">
                <label for="historyNote" class="form-label">Why would you like to adopt this pet?</label>
                <textarea id="historyNote" name="historyNote" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Adoption Request</button>
        </form>
    </div>
</body>
</html>
