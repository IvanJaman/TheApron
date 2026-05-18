<?php
require_once "config/db.php";

$stmt = $pdo->prepare("SELECT id, title, image_url FROM recipes");
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Apron</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1 class="page-title">What are we cooking today?</h1>

<div class="grid">
    <?php foreach ($recipes as $recipe): ?>
        <a class="card" href="recipe.php?id=<?= $recipe['id'] ?>">
            <img src="/theapron<?= $recipe['image_url'] ?>">
            <div class="card-title">
                <?= htmlspecialchars($recipe['title']) ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>

</body>
</html>