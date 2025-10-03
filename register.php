<?php
require_once "../includes/config.php"; // session already started here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"] ?? '';

    // Validation
    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);

        if ($stmt->fetch()) {
            $error = "Username already exists.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute([
                'username' => $username,
                'password' => $hashed_password
            ]);

            header("Location: login.php");
            exit;
        }
    }
}

require "../includes/header.php";
?>

<h2>Register</h2>

<?php if(isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
<form method="post">
  <div class="mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Confirm Password</label>
    <input type="password" name="confirm_password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Register</button>
</form>

<?php require "../includes/footer.php"; ?>
