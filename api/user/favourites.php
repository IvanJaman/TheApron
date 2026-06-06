<?php

require_once "../../config/db.php";
require_once "../../config/auth.php";

requireLogin();

$userId = $_SESSION["user_id"];
$recipeId = $_POST["recipe_id"];

$stmt = $pdo->prepare("
    SELECT id
    FROM favourites
    WHERE user_id = ? AND recipe_id = ?
");

$stmt->execute([$userId, $recipeId]);

$existing = $stmt->fetch();

if ($existing) {

    $stmt = $pdo->prepare("
        DELETE FROM favourites
        WHERE user_id = ? AND recipe_id = ?
    ");

    $stmt->execute([$userId, $recipeId]);

    echo json_encode([
        "status" => "removed"
    ]);

} else {

    $stmt = $pdo->prepare("
        INSERT INTO favourites(user_id, recipe_id)
        VALUES(?, ?)
    ");

    $stmt->execute([$userId, $recipeId]);

    echo json_encode([
        "status" => "added"
    ]);
}