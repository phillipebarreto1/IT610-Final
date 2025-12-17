<?php
require __DIR__ . "/config.php";

if (isset($_SESSION["user_id"])) {
  header("Location: /dashboard.php");
  exit;
}
?>
<!doctype html>
<html>
  <body>
    <h1>Simple Games App</h1>
    <p><a href="/register.php">Register</a> | <a href="/login.php">Login</a></p>
  </body>
</html>
