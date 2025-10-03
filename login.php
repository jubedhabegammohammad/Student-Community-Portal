<?php
require_once "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["email"]); // rename variable to username
    $password = $_POST["password"];

    // Query by username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid login details.";
    }
}

require "../includes/header.php";
?>

<h2>Login</h2>
<form method="post">
  <div class="mb-3">
    <label>Username</label>
    <input type="text" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Login</button>
</form>
<?php if(isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

<?php require "../includes/footer.php"; ?>
