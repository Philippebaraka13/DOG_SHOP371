<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
require 'db.php'; // Ensure this path correctly points to your database connection file
require 'vendor/autoload.php'; // Autoload for PHPMailer

// This will hold the response we will return
$response = [];

// Redirect if not logged in or if no adoption form data is received
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_POST['dog_id'], $_POST['historyNote'])) {
    $response['message'] = 'You must be logged in to submit an adoption request.';
    echo json_encode($response);
    exit;
}

$dog_id = $_POST['dog_id'];
$user_id = $_SESSION['userID'];
$historyNote = $_POST['historyNote'];
$adoptionStatus = 'pending';

// Prepare and execute the dog query
$dogQuery = $conn->prepare("SELECT DogName, DogBreed FROM Dogtable WHERE DogID = ?");
$dogQuery->bind_param("i", $dog_id);
$dogQuery->execute();
$dogResult = $dogQuery->get_result();
$dog = $dogResult->fetch_assoc();

if (!$dog) {
    $response['message'] = "No such dog found.";
    echo json_encode($response);
    exit;
}

// Prepare and execute the history insert
$sql = "INSERT INTO History (AdoptionDate, AdoptionStatus, HistoryNote, Dogtable_DogID, UserTable_UserID) VALUES (CURDATE(), ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssii", $adoptionStatus, $historyNote, $dog_id, $user_id);
    if ($stmt->execute()) {
        // Prepare and execute the user email query
        $sql = "SELECT Email, Username FROM UserTable WHERE UserID = ?";
        $emailStmt = $conn->prepare($sql);
        $emailStmt->bind_param("i", $user_id);
        $emailStmt->execute();
        $result = $emailStmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $userEmail = $row['Email'];
            $userName = $row['Username'];

            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'shodog825@gmail.com'; // SMTP username
                $mail->Password = 'zwyt bzcm nfkz fxko'; // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('from@example.com', 'Dog Adoption Center');
                $mail->addAddress($userEmail, $userName); // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Adoption Request Confirmation';
                $mail->Body    = "Hello $userName,<br>Thank you for your adoption request for <strong>" . htmlspecialchars($dog['DogName']) . "</strong>. Your request is currently being processed.<br><br>History Note: $historyNote<br><br>Thank you,<br>DogShop Team";

                $mail->send();
                $response['message'] = 'Your adoption request has been submitted successfully. A confirmation email has been sent.';
            } catch (Exception $e) {
                $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $response['message'] = "User email not found.";
        }
        $emailStmt->close();
    } else {
        $response['message'] = "Error submitting the adoption request: " . $stmt->error;
    }
    $stmt->close();
} else {
    $response['message'] = "Error preparing the statement: " . $conn->error;
}

$conn->close();
echo json_encode($response); // Encode the response as JSON
?>













