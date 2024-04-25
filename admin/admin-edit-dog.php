<?php
session_start();
include 'db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle the update operation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $dogID = $_POST['dogID'];
    $dogName = $_POST['dogName'];
    $dogBreed = $_POST['dogBreed'];
    $dogSex = $_POST['dogSex'];
    $dogAge = $_POST['dogAge'];
    $dogColor = $_POST['dogColor'];
    $dogSize = $_POST['dogSize'];
    $dogDescription = $_POST['dogDescription'];

    $sql = "UPDATE Dogtable SET DogName=?, DogBreed=?, DogSex=?, DogAge=?, DogColor=?, DogSize=?, DogDescription=? WHERE DogID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssi", $dogName, $dogBreed, $dogSex, $dogAge, $dogColor, $dogSize, $dogDescription, $dogID);
    if ($stmt->execute()) {
        header("Location: admin-manage-dogs.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch the dog's current data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM Dogtable WHERE DogID = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $dog = $result->fetch_assoc();
    if (!$dog) {
        header("Location: admin-manage-dogs.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Edit Dog Details</h1>
    <form method="post" action="admin-edit-dog.php">
        <input type="hidden" name="dogID" value="<?php echo $dog['DogID']; ?>">

        <div class="mb-3">
            <label for="dogName" class="form-label">Dog Name</label>
            <input type="text" class="form-control" id="dogName" name="dogName" required value="<?php echo htmlspecialchars($dog['DogName']); ?>">
        </div>

        <div class="mb-3">
            <label for="dogBreed" class="form-label">Dog Breed</label>
            <input type="text" class="form-control" id="dogBreed" name="dogBreed" required value="<?php echo htmlspecialchars($dog['DogBreed']); ?>">
        </div>

        <div class="mb-3">
            <label for="dogSex" class="form-label">Dog Sex</label>
            <select class="form-control" id="dogSex" name="dogSex" required>
                <option value="Male" <?php echo $dog['DogSex'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo $dog['DogSex'] === 'Female' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="dogAge" class="form-label">Dog Age</label>
            <input type="number" class="form-control" id="dogAge" name="dogAge" required value="<?php echo htmlspecialchars($dog['DogAge']); ?>">
        </div>

        <div class="mb-3">
            <label for="dogColor" class="form-label">Dog Color</label>
            <input type="text" class="form-control" id="dogColor" name="dogColor" required value="<?php echo htmlspecialchars($dog['DogColor']); ?>">
        </div>

        <div class="mb-3">
            <label for="dogSize" class="form-label">Dog Size</label>
            <input type="text" class="form-control" id="dogSize" name="dogSize" required value="<?php echo htmlspecialchars($dog['DogSize']); ?>">
        </div>

        <div class="mb-3">
            <label for="dogDescription" class="form-label">Dog Description</label>
            <textarea class="form-control" id="dogDescription" name="dogDescription" required><?php echo htmlspecialchars($dog['DogDescription']); ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Details</button>
    </form>
</div>

</body>
</html>
