<?php
require_once "../includes/config.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$post_id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $body = trim($_POST["body"]);
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, body) VALUES (?, ?, ?)");
    $stmt->execute([$post_id, $_SESSION['user_id'], $body]);
    header("Location: post.php?id=" . $post_id);
    exit;
}

$comments = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY comments.created_at DESC");
$comments->execute([$post_id]);

require "../includes/header.php";
?>

<div class="card mb-3">
  <div class="card-body">
    <h3><?= htmlspecialchars($post['title']) ?></h3>
    <p><?= nl2br(htmlspecialchars($post['body'])) ?></p>
    <small>By <?= htmlspecialchars($post['username']) ?> on <?= $post['created_at'] ?></small>
  </div>
</div>

<h4>Comments</h4>
<?php foreach($comments as $c): ?>
  <div class="border p-2 mb-2">
    <strong><?= htmlspecialchars($c['username']) ?></strong>: 
    <?= nl2br(htmlspecialchars($c['body'])) ?>
    <br><small><?= $c['created_at'] ?></small>
  </div>
<?php endforeach; ?>

<?php if(isset($_SESSION['user_id'])): ?>
<form method="post">
  <textarea name="body" class="form-control mb-2" required></textarea>
  <button class="btn btn-primary">Add Comment</button>
</form>
<?php else: ?>
<p><a href="login.php">Login</a> to comment.</p>
<?php endif; ?>

<?php require "../includes/footer.php"; ?>
