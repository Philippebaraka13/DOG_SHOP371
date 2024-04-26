
<?php
// Start the session
session_start();

// Include the header
include 'header.php';

// Include database connection file
require_once 'db.php'; // Ensure this points to your actual database connection file

// Define variables and initialize with empty values
$contactName = $contactEmail = $contactMessage = "";
$errorMessage = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["contactName"]))) {
        $errorMessage = "Please enter your name.";
    } else {
        $contactName = trim($_POST["contactName"]);
    }

    // Validate email
    if (empty(trim($_POST["contactEmail"]))) {
        $errorMessage = "Please enter your email.";
    } else {
        $contactEmail = trim($_POST["contactEmail"]);
    }

    // Validate message
    if (empty(trim($_POST["contactMessage"]))) {
        $errorMessage = "Please enter your message.";
    } else {
        $contactMessage = trim($_POST["contactMessage"]);
    }

    // Check input errors before inserting in database
    if (empty($errorMessage)) {
        // Prepare an insert statement
        $sql = "INSERT INTO ContactMessages (name, email, message) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_message);

            // Set parameters
            $param_name = $contactName;
            $param_email = $contactEmail;
            $param_message = $contactMessage;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Set a session variable to indicate success
                $_SESSION['message_sent'] = true;
                // Redirect to the same page to clear the form
                header("Location: contact.php");
                exit();
            } else {
                $errorMessage = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Check if the message was sent successfully and display the success message
    if (isset($_SESSION['message_sent']) && $_SESSION['message_sent']) {
        echo '<p class="alert alert-success">Thank you for your message. We will get back to you shortly.</p>';
        // Clear the session variable so it doesn't show the message upon subsequent accesses
        unset($_SESSION['message_sent']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="container mt-4">
    <h1 class="text-center mb-4">Contact Us</h1>
    <section class="mb-5">
        <h2>Get in Touch</h2>
        <p>Have questions about our adoption process or need assistance? Please fill out the form below, and one of our team members will get back to you shortly.</p>
        <form method="post" action="contact.php">
            <div class="mb-3">
                <label for="contactName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="contactName" name="contactName" required value="<?= htmlspecialchars($contactName); ?>">
            </div>
            <div class="mb-3">
                <label for="contactEmail" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="contactEmail" name="contactEmail" required value="<?= htmlspecialchars($contactEmail); ?>">
            </div>
            <div class="mb-3">
                <label for="contactMessage" class="form-label">Your Message</label>
                <textarea class="form-control" id="contactMessage" name="contactMessage" rows="5" required><?= htmlspecialchars($contactMessage); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>
    
    <section class="mb-5">
        <h2>Location</h2>
        <address>
            1340 Administration Ave<br>
            Fargo, ND 58103<br>
            <abbr title="Phone">Phone:</abbr> (123) 456-7890
            <br>
           Email: <a href= "mailto: seid.abdu01@gmail.com"> seid.abdu01@gmail.com</a>
        </address>
    </section>
    
    <section class="mb-5">
        <h2>Business Hours</h2>
        <p>Monday - Friday: 9 AM to 7 PM</p>
        <p>Saturday: 10 AM to 5 PM</p>
        <p>Sunday: Closed</p>
    </section>
</main>

<?php
// Include the footer
include 'footer.php';
?>

</body>
</html>