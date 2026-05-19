<?php
require_once "config/db.php";
require_once "config/auth.php";
requireLogin();

if (!isset($_GET['id'])) {
    die("Recipe ID is missing.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
$stmt->execute([$id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    die("Recipe not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($recipe['title']) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">The Apron</div>
    <div class="hamburger" id="hamburger">☰</div>
    <div class="nav-links" id="navLinks">
        <a href="index.php">Početna</a>
    </div>
</nav>

<main class="container">
    <div class="recipe-layout">
        <div class="recipe-image">
            <img src="/theapron<?= $recipe['image_url'] ?>" alt="<?= htmlspecialchars($recipe['title']) ?>">
        </div>
        <div class="recipe-content">
            <h1><?= htmlspecialchars($recipe['title']) ?></h1>

            <h3>Description</h3>
            <p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

            <h3>Ingredients</h3>
            <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

            <h3>Instructions</h3>
            <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>
        </div>
    </div>
</main>

<footer class="footer">
    <p>© 2026 The Apron. All rights reserved.</p>
</footer>

<script>
    const hamburger = document.getElementById("hamburger");
    const navLinks = document.getElementById("navLinks");

    hamburger.addEventListener("click", (e) => {
        e.stopPropagation();
        navLinks.classList.toggle("active");
    });

    document.addEventListener("click", () => {
        navLinks.classList.remove("active");
    });
</script>

</body>
</html>