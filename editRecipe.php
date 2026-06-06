<?php
require_once "config/db.php";
require_once "config/auth.php";
requireAdmin();

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
$stmt->execute([$id]);
$recipe = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmt = $pdo->prepare("
        UPDATE recipes 
        SET title=?, description=?, ingredients=?, instructions=?, image_url=?, category_id=?
        WHERE id=?
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

<form method="POST">
    <input name="title" value="<?= $recipe['title'] ?>"><br>
    <textarea name="description"><?= $recipe['description'] ?></textarea><br>
    <textarea name="ingredients"><?= $recipe['ingredients'] ?></textarea><br>
    <textarea name="instructions"><?= $recipe['instructions'] ?></textarea><br>
    <input name="image_url" value="<?= $recipe['image_url'] ?>"><br>
    <input name="category_id" value="<?= $recipe['category_id'] ?>"><br>

    <button type="submit">Spremi izmjene</button>
</form>