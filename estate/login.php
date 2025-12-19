<?php
session_start();
require_once "config.php";

$error = "";
$success = "";

/* ================= LOGIN ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone']; 
           header("Location: http://localhost/estate/home.php");
            exit;

        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "Email not found!";
    }
}

/* ================= REGISTER ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $username, $email, $phone, $password);

    try {
        if ($stmt->execute()) {
            $success = "Account created successfully! You can login now.";
        }
    } catch (mysqli_sql_exception $e) {
        if ($conn->errno === 1062) {
            $error = "Email or Username already exists!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Elite Real Estate - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body class="login-page">

<div class="login-container">

    <div class="logo-header">
        <h1>Elite Real Estate</h1>
        <p><strong>Find your dream home</strong></p>
    </div>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- LOGIN -->
    <form method="post" action="login.php" id="login-form" class="form-section active">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <p>No account? <span id="show-register">Register here</span></p>
    </form>

    <!-- REGISTER -->
    <form method="post" action="login.php" id="register-form" class="form-section">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="phone" placeholder="Phone (Optional)">
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
        <p>Already have an account? <span id="show-login">Login here</span></p>
    </form>

</div>

<script>
document.getElementById("show-register")?.addEventListener("click", () => {
    document.getElementById("login-form").classList.remove("active");
    document.getElementById("register-form").classList.add("active");
});

document.getElementById("show-login")?.addEventListener("click", () => {
    document.getElementById("register-form").classList.remove("active");
    document.getElementById("login-form").classList.add("active");
});
</script>

</body>
</html>
