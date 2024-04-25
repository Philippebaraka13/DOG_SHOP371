<?php
// Start the session
session_start();

// Include the header
include 'header.php';

// Assuming you would process the contact form data similarly to how you did with the message form
// Add your form processing logic here if needed

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
                <input type="text" class="form-control" id="contactName" name="contactName" required>
            </div>
            <div class="mb-3">
                <label for="contactEmail" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="contactEmail" name="contactEmail" required>
            </div>
            <div class="mb-3">
                <label for="contactMessage" class="form-label">Your Message</label>
                <textarea class="form-control" id="contactMessage" name="contactMessage" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>
    
    <section class="mb-5">
        <h2>Our Location</h2>
        <address>
            1234 Puppy Lane<br>
            Barkstown, DO 56789<br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
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
