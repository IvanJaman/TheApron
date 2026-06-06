<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION["user_id"]);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /TheApron/login.php");
        exit;
    }
}

function requireAdmin() {
    if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
        header("Location: index.php");
        exit;
    }
}
?>