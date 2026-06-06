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

$userId = $_SESSION["user_id"];

$favStmt = $pdo->prepare("
    SELECT id
    FROM favourites
    WHERE user_id = ? AND recipe_id = ?
");

$favStmt->execute([$userId, $id]);

$isFavourite = $favStmt->fetch();
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
    <div class="recipe-actions">
        <button class="favourites-btn">
            <?= $isFavourite ? "Ukloni iz omiljenih" : "Dodaj u omiljene" ?>
        </button>
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

<script>
document.querySelector(".favourites-btn").addEventListener("click", async () => {

    const response = await fetch(
        "api/user/favourites.php",
        {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "recipe_id=<?= $id ?>"
        }
    );

    const data = await response.json();

    if (data.status === "added") {
        document.querySelector(".favourites-btn").innerText = "Ukloni iz omiljenih";
    } else {
        document.querySelector(".favourites-btn").innerText = "Dodaj u omiljene";
    }
});
</script>

</body>
</html>