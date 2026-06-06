<?php
require_once "config/db.php";
require_once "config/auth.php";
requireLogin();

$stmt = $pdo->prepare("SELECT id, title, image_url FROM recipes");
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Apron</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar">
    <a class="logo" href="index.php">The Apron</a>
    <div class="hamburger" id="hamburger">
        ☰
    </div>
    <div class="nav-links" id="navLinks">
        <a href="index.php">Početna</a>
        <a href="favourites.php">Omiljeno</a>
        <?php if (isLoggedIn()): ?>
            <a href="logout.php">Odjava</a>
        <?php else: ?>
            <a href="login.php">Prijava</a>
        <?php endif; ?>
    </div>
</nav>

    <main class="container">
        <h1 class="page-title">Pozdrav, chef <?= $_SESSION["username"] ?>! Što ćemo kuhati danas?</h1>
        <div class="grid">
            <?php foreach ($recipes as $recipe): ?>
                <a class="card" href="recipe.php?id=<?= $recipe['id'] ?>">
                    <img src="/theapron<?= $recipe['image_url'] ?>" alt="<?= $recipe['title'] ?>">
                    <div class="card-title">
                        <?= htmlspecialchars($recipe['title']) ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer">
        <p>© 2026 The Apron. Sva prava zadržana.</p>
    </footer>
    <script>
        const hamburger = document.getElementById("hamburger");
        const navLinks = document.getElementById("navLinks");

        hamburger.addEventListener("click", (e) => {
            e.stopPropagation();
            navLinks.classList.toggle("active");
        });

        navLinks.addEventListener("click", (e) => {
            e.stopPropagation();
        });

        document.addEventListener("click", () => {
            navLinks.classList.remove("active");
        });
    </script>
</body>
</html>