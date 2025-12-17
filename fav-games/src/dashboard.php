<?php
require __DIR__ . "/config.php";
require_login();

$userId = $_SESSION["user_id"];
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $game = trim($_POST["game_title"] ?? "");
  if ($game === "") {
    $error = "Game title required.";
  } else {
    $stmt = $pdo->prepare("INSERT INTO favorite_games (user_id, game_title) VALUES (?, ?)");
    $stmt->execute([$userId, $game]);
    header("Location: /dashboard.php");
    exit;
  }
}

$stmt = $pdo->prepare("SELECT id, game_title, created_at FROM favorite_games WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$userId]);
$favorites = $stmt->fetchAll();
?>
<!doctype html>
<html>
  <body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION["username"]) ?></h2>
    <p><a href="/logout.php">Logout</a></p>

    <h3>Add favorite game</h3>
    <?php if ($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST">
      <input name="game_title" placeholder="e.g., Elden Ring" />
      <button type="submit">Save</button>
    </form>

    <h3>Your favorites</h3>
    <ul>
      <?php foreach ($favorites as $g): ?>
        <li><?= htmlspecialchars($g["game_title"]) ?> (<?= htmlspecialchars($g["created_at"]) ?>)</li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
