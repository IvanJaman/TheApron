<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

        try {
            $stmt->execute([$username, $email, $password]);

            $_SESSION["user_id"] = $pdo->lastInsertId();
            $_SESSION["username"] = $username;

            header("Location: index.php");
            exit;

        } catch (Exception $e) {
            $error = "User already exists or invalid data.";
        }
    }
    ?>
   <div class="auth-page">
        <h1 class="page-title">Welcome to The Apron!</h1>
        <div class="auth-box">

            <h2>Register</h2>

            <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

            <form method="POST">
                <input name="username" placeholder="Username" required>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>

            <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>