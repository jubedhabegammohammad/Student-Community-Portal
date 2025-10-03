<?php
require_once "../includes/config.php";
require_once "../includes/header.php";

$stmt = $pdo->query("SELECT posts.*, users.username 
                     FROM posts JOIN users ON posts.user_id = users.id 
                     ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Recent Posts</h2>
<?php foreach($posts as $post): ?>
  <div class="card mb-3">
    <div class="card-body">
      <h4><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h4>
      <p><?= nl2br(htmlspecialchars(substr($post['body'],0,200))) ?>...</p>
      <small>By <?= htmlspecialchars($post['username']) ?> on <?= $post['created_at'] ?></small>
    </div>
  </div>
<?php endforeach; ?>

<?php require_once "../includes/footer.php"; ?>
