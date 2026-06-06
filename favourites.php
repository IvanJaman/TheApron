<?php
require_once "config/db.php";
require_once "config/auth.php";

requireLogin();

$userId = $_SESSION["user_id"];

$stmt = $pdo->prepare("
    SELECT recipes.id, recipes.title, recipes.image_url
    FROM favourites
    JOIN recipes ON favourites.recipe_id = recipes.id
    WHERE favourites.user_id = ?
");

$stmt->execute([$userId]);

$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Omiljeni recepti</title>
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

        <?php if (isLoggedIn() && $_SESSION["role"] === "admin"): ?>
            <a href="addRecipe.php">Dodaj novi recept</a>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <a href="logout.php">Odjava</a>
            
        <?php else: ?>
            <a href="login.php">Prijava</a>
        <?php endif; ?>
    </div>
</nav>

<main class="container">
    <h1 class="page-title">Moji omiljeni recepti</h1>
    <div class="grid">
        <?php foreach ($recipes as $recipe): ?>
            <a class="card" href="recipe.php?id=<?= $recipe['id'] ?>">
                <img src="/TheApron<?= $recipe['image_url'] ?>">
                <div class="card-title">
                    <?= htmlspecialchars($recipe['title']) ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</main>

<script>
const hamburger = document.getElementById("hamburger");
const navLinks = document.getElementById("navLinks");

hamburger.addEventListener("click", () => {
    navLinks.classList.toggle("active");
});

document.addEventListener("click", (e) => {
    if (!hamburger.contains(e.target) && !navLinks.contains(e.target)) {
        navLinks.classList.remove("active");
    }
});
</script>
</body>
</html>