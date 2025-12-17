<?php
require __DIR__ . "/config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? "");
  $password = $_POST["password"] ?? "";

  $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if (!$user || !password_verify($password, $user["password_hash"])) {
    $error = "Invalid username or password.";
  } else {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $username;
    header("Location: /dashboard.php");
    exit;
  }
}
?>
<!doctype html>
<html>
  <body>
    <h2>Login</h2>
    <?php if ($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST">
      <label>Username</label><br />
      <input name="username" /><br /><br />
      <label>Password</label><br />
      <input name="password" type="password" /><br /><br />
      <button type="submit">Login</button>
    </form>
    <p><a href="/register.php">Register</a></p>
  </body>
</html>
