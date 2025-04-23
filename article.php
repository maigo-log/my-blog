<?php
require_once 'db_config.php';

$id = $_GET['id'];  // URLから記事IDを取得

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title><?= htmlspecialchars($article['title']) ?></title>
</head>
<body>
  <nav class="navbar">
    <a href="index.php">Home</a>
    <a href="blog.php">Blog</a>
    <a href="index.html#profile-card">About me</a>
    <a href="post.php">blog</a>
  </nav>

  <div class="container article-detail">
    <h1 class="article-title"><?= htmlspecialchars($article['created_at']) ?> – <?= htmlspecialchars($article['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
  </div>
</body>
</html>
