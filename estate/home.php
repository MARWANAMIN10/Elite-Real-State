<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Real Estate - Home</title>
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/home.css">
</head>
<body>

<!-- Navigation -->
<nav class="navbar">
    <div class="logo">Elite Real Estate</div>
    <ul class="nav-links">
        <li><a href="home.php" class="active-link">Home</a></li>
        <li><a href="properties.php">Properties</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Find Your Dream Home</h1>
        <p>Browse the best properties in your city with trusted real estate agents</p>
        <a href="properties.php" class="btn">Browse Properties</a>
    </div>
</section>

<!-- Featured Properties -->
<section class="properties">
    <h2 class="section-title">Featured Properties</h2>
    <p class="section-subtitle">Top listings hand-picked for you</p>

    <div class="property-list">

        <div class="property">
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994" alt="Luxury Villa">
            <h3>Luxury Villa</h3>
            <p>5 Bedrooms · 3 Bathrooms · Cairo</p>
            <a href="details.php?id=villa" class="btn">View Details</a>
        </div>

        <div class="property">
            <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be" alt="Modern Apartment">
            <h3>Modern Apartment</h3>
            <p>2 Bedrooms · 2 Bathrooms · Alexandria</p>
            <a href="details.php?id=apartment" class="btn">View Details</a>
        </div>

        <div class="property">
            <img src="https://images.unsplash.com/photo-1572120360610-d971b9d7767c" alt="Family Home">
            <h3>Family Home</h3>
            <p>3 Bedrooms · 2 Bathrooms · Giza</p>
            <a href="details.php?id=family" class="btn">View Details</a>
        </div>

    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <p>© 2025 Elite Real Estate. All rights reserved.</p>
</footer>

<script src="scripts/properties.js"></script>
</body>
</html>
