<?php
session_start(); // Ensure session start is at the top to access session variables

// Check if the user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['userType'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'db.php'; // Include your database connection settings

// Initialize variables to prevent undefined index notices
$historyId = $newStatus = $historyNote = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateStatus'], $_POST['historyId'], $_POST['adoptionStatus'], $_POST['historyNote'])) {
    $historyId = $_POST['historyId']; // Get history ID from form submission
    $newStatus = $_POST['adoptionStatus']; // Get the new status from form submission
    $historyNote = $_POST['historyNote']; // Get any notes from form submission

    // Update the adoption status in the database
    $sql = "UPDATE History SET AdoptionStatus = ?, HistoryNote = ? WHERE HistoryID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $newStatus, $historyNote, $historyId);
        $stmt->execute();
        $stmt->close();

        // Fetch user's email to send notification
        $sql = "SELECT UserTable.Email, UserTable.Username FROM History JOIN UserTable ON History.UserTable_UserID = UserTable.UserID WHERE HistoryID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $historyId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($user = $result->fetch_assoc()) {
                $userEmail = $user['Email'];
                $userName = $user['Username'];

                // Prepare and send email notification
                $subject = "Adoption Request Update";
                $headers = "From: noreply@yourdomain.com\r\n";
                $headers .= "Reply-To: support@yourdomain.com\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                $message = "Dear $userName,\n\n";
                $message .= "Your adoption request has been updated to: $newStatus.\n";
                $message .= "Notes: $historyNote\n";
                $message .= "Thank you for using our services. If you have any questions, please contact us.\n\n";
                $message .= "Best Regards,\n";
                $message .= "Animal Adoption Center";

                if(mail($userEmail, $subject, $message, $headers)) {
                    echo "Notification sent successfully to $userEmail.";
                } else {
                    echo "Failed to send notification.";
                }
            }
            $stmt->close();
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<!-- HTML form for admin to update the adoption status -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Adoption Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Update Adoption Status</h1>
        <form action="update_request.php" method="post">
            <div class="mb-3">
                <label for="historyId" class="form-label">History ID:</label>
                <input type="text" class="form-control" id="historyId" name="historyId" required>
            </div>
            <div class="mb-3">
                <label for="adoptionStatus" class="form-label">Adoption Status:</label>
                <select class="form-control" id="adoptionStatus" name="adoptionStatus">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="denied">Denied</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="historyNote" class="form-label">History Note:</label>
                <textarea class="form-control" id="historyNote" name="historyNote" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="updateStatus">Update Status</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
