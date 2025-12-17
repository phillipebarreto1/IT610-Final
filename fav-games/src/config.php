<?php
session_start();

$host = getenv("DB_HOST") ?: "db";
$db   = getenv("DB_NAME") ?: "appdb";
$user = getenv("DB_USER") ?: "appuser";
$pass = getenv("DB_PASS") ?: "apppass";

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
} catch (Exception $e) {
  die("DB connection failed: " . htmlspecialchars($e->getMessage()));
}

function require_login() {
  if (!isset($_SESSION["user_id"])) {
    header("Location: /login.php");
    exit;
  }
}
