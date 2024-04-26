
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | Animal Adoption Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="admin-styles.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin-dashboard.php">
            <img src="images/doglogo.jpeg" alt="doglogo" width="80" height="60">
            Admin Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin-add-dog.php">Add a Dog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-manage-dogs.php">Manage Dogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-view-contact-messages.php">View Contact Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
