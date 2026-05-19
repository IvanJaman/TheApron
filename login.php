<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
require_once "config/db.php";
require_once "config/auth.php";

if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: index.php");
        exit;

    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<div class="auth-page">

    <h1 class="page-title">Welcome back to The Apron!</h1>

    <div class="auth-box">

        <h2>Login</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST">
            <input name="username" type="text" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <a href="register.php">Register</a>

    </div>

</div>

</body>
</html>