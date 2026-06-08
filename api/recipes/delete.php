<?php
require_once "../../config/db.php";
require_once "../../config/auth.php";
requireAdmin();

header("Content-Type: application/json");

$id = $_POST["id"];

$stmt = $pdo->prepare("DELETE FROM recipes WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(["status" => "ok"]);