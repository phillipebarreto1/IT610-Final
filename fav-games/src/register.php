<?php
require __DIR__ . "/config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? "");
  $password = $_POST["password"] ?? "";

  if ($username === "" || $password === "") {
    $error = "Username and password required.";
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    try {
      $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
      $stmt->execute([$username, $hash]);
      header("Location: /login.php");
      exit;
    } catch (Exception $e) {
      $error = "That username may already be taken.";
    }
  }
}
?>
<!doctype html>
<html>
  <body>
    <h2>Register</h2>
    <?php if ($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST">
      <label>Username</label><br />
      <input name="username" /><br /><br />
      <label>Password</label><br />
      <input name="password" type="password" /><br /><br />
      <button type="submit">Create account</button>
    </form>
    <p><a href="/login.php">Login</a></p>
  </body>
</html>
