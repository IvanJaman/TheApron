<?php
require_once "../../config/db.php";
require_once "../../config/auth.php";
requireAdmin();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

$title = $_POST["title"];
$description = $_POST["description"];
$ingredients = $_POST["ingredients"];
$instructions = $_POST["instructions"];
$image_url = $_POST["image_url"];
$category_id = $_POST["category_id"];

$stmt = $pdo->prepare("
    INSERT INTO recipes (title, description, ingredients, instructions, image_url, category_id)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->execute([$title, $description, $ingredients, $instructions, $image_url, $category_id]);

header("Location: ../../index.php");
exit;