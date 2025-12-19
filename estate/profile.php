<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Real Estate - Profile</title>
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/profile.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">Elite Real Estate</div>
        <ul class="nav-links">
            <li><a href="home.php" id="nav-home">Home</a></li>
            <li><a href="properties.php" id="nav-properties" >Properties</a></li>
            <li><a href="profile.php" id="nav-profile" class="active-link">Profile</a></li>
            <li><a href="contact.php" id="nav-contact">Contact</a></li>
            <li><a href="index.php" id="nav-logout">Logout</a></li>
        </ul>
    </nav>

    <!-- Profile Section -->
    <section class="profile-section">
        <h2 class="section-title">User Profile</h2>
        <div class="profile-details">
            <p><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email'] ?? 'Not available') ?></p>
            <p><strong>Member Since:</strong> December 2025</p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($_SESSION['phone'] ?? 'Not available') ?></p>
            <p><strong>Total Listings Viewed:</strong> 15</p>
            <p><strong>Saved Properties:</strong> 3</p>
            <p><strong>Contact Requests:</strong> 2</p>
        </div>
        
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 Elite Real Estate. All rights reserved.</p>
    </footer>

    <script src="scripts/profile.js"></script>
</body>
</html>