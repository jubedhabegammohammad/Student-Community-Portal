<?php
require_once "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $body = trim($_POST["body"]);

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, body) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $title, $body]);

    header("Location: index.php");
    exit;
}

require "../includes/header.php";
?>

<h2>New Post</h2>
<form method="post">
  <div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Body</label>
    <textarea name="body" class="form-control" rows="5" required></textarea>
  </div>
  <button class="btn btn-success">Publish</button>
</form>

<?php require "../includes/footer.php"; ?>
