<?php
require_once "config/db.php";
require_once "config/auth.php";
requireAdmin();

$stmt = $pdo->query("SELECT id, name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dodaj recept</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-page">
    <h1 class="page-title">Dodaj novi recept</h1>
    <div class="auth-box">

        <form method="POST" action="api/recipes/create.php">

            <input name="title" placeholder="Naziv recepta" required>

            <textarea name="description" placeholder="Opis" required></textarea>

            <textarea name="ingredients" placeholder="Sastojci" required></textarea>

            <textarea name="instructions" placeholder="Priprema" required></textarea>

            <input name="image_url" placeholder="/images/example.jpg" required>

            <select name="category_id" required>
                <option value="">Odaberi kategoriju</option>

                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat["id"] ?>">
                        <?= htmlspecialchars($cat["name"]) ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <button type="submit">Spremi recept</button>
        </form>
    </div>
</div>
</body>
</html>