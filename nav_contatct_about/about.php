<?php
// Start the session
session_start();

// Include the header
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | DogShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="container mt-4">
    <h1 class="text-center mb-4">About DogShop</h1>
    <section class="mb-5">
        <h2>Our Mission</h2>
        <p>
            At DogShop, our mission is to connect loving dogs with warm homes. We believe every dog deserves a chance at happiness and strive to make that a reality through our adoption program.
        </p>
    </section>
    
    <section class="mb-5">
        <h2>Our Story</h2>
        <p>
            Founded in 2010 by a group of dog enthusiasts, DogShop began as a small community effort to help stray and abandoned dogs. Today, we've grown into a full-fledged adoption center, offering shelter, medical care, and love to dogs in need.
        </p>
    </section>
    
    <section class="mb-5">
        <h2>Why Adopt With Us?</h2>
        <p>
            With a focus on rehabilitation and quality care, we ensure that every dog is healthy, well-behaved, and ready for a new life with a caring owner. Our team of volunteers works tirelessly to prepare our dogs for the transition to a permanent home.
        </p>
    </section>
    
    <section class="mb-5">
        <h2>Success Stories</h2>
        <article>
            <h3>Max Finds a Home</h3>
            <p>
                Max, a spirited Labrador Retriever, came to us with a troubled past. Thanks to our behavioral training program, Max transformed into a loving and obedient companion. He's now enjoying life with the Johnson family, who report he's become an irreplaceable part of their home.
            </p>
        </article>
        <article>
            <h3>Bella's New Beginnings</h3>
            <p>
                Bella, a shy Cocker Spaniel, was once timid and fearful. Through our socialization workshops, she gained confidence and became a playful and joyful dog. Bella now lives with her new owner, Sarah, who says Bella has brought endless joy to her life.
            </p>
        </article>
    </section>
    
</main>

<?php
// Include the footer
include 'footer.php';
?>

</body>
</html>
