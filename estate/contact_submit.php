<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "estate");

if ($conn->connect_error) {
    die("DB Error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

$property_interest = $_POST['property_interest'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';
$preferred_agent = $_POST['preferred_agent'] ?? '';
$status = 'new'; // Default status for new inquiries

$sql = "INSERT INTO inquiries 
(property_interest, name, email, phone, message, preferred_agent, status, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssss",
    $property_interest,
    $name,
    $email,
    $phone,
    $message,
    $preferred_agent,
    $status
);

if ($stmt->execute()) {
    echo "";
} else {
    echo "Insert error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Real Estate - Profile</title>
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/profile.css">
    <style>footer {
            
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #0077b6;
            color: white;
            text-align: center;
            padding: 15px;
            
        }
        </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">Elite Real Estate</div>
        <ul class="nav-links">
            <li><a href="home.php" >Home</a></li>
            <li><a href="properties.php" id="nav-properties" >Properties</a></li>
            <li><a href="profile.php" id="nav-profile" >Profile</a></li>
            <li><a href="contact.php" id="nav-contact" id="nav-home" class="active-link">Contact</a></li>
            <li><a href="index.php" id="nav-logout">Logout</a></li>
        </ul>
    </nav>
    <h1>Thank you, someone is gonna reach out for you</h1>
    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 Elite Real Estate. All rights reserved.</p>
    </footer>

    <script src="scripts/profile.js"></script>
</body>
</html>