<?php
require_once "config/db.php";
require_once "config/auth.php";
requireAdmin();

if (!isset($_GET["id"])) {
    die("Recipe ID missing.");
}

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
$stmt->execute([$id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    die("Recipe not found.");
}

$stmt = $pdo->query("SELECT id, name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmt = $pdo->prepare("
        UPDATE recipes
        SET title = ?,
            description = ?,
            ingredients = ?,
            instructions = ?,
            image_url = ?,
            category_id = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $_POST["title"],
        $_POST["description"],
        $_POST["ingredients"],
        $_POST["instructions"],
        $_POST["image_url"],
        $_POST["category_id"],
        $id
    ]);
    header("Location: recipe.php?id=$id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi recept</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="auth-page">
    <h1 class="page-title">Uredi recept</h1>
    <div class="auth-box">
        <form method="POST">
            <input
                name="title"
                value="<?= htmlspecialchars($recipe['title']) ?>"
                placeholder="Naziv recepta"
                required
            >
            <textarea
                name="description"
                placeholder="Opis"
                required
            ><?= htmlspecialchars($recipe['description']) ?></textarea>
            <textarea
                name="ingredients"
                placeholder="Sastojci"
                required
            ><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
            <textarea
                name="instructions"
                placeholder="Priprema"
                required
            ><?= htmlspecialchars($recipe['instructions']) ?></textarea>
            <input
                name="image_url"
                value="<?= htmlspecialchars($recipe['image_url']) ?>"
                placeholder="/images/example.jpg"
                required
            >
            <select name="category_id" required>
                <?php foreach ($categories as $cat): ?>
                    <option
                        value="<?= $cat['id'] ?>"
                        <?= $cat['id'] == $recipe['category_id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Spremi izmjene</button>
        </form>
    </div>
</div>
</body>
</html>