<?php
require_once 'db_config.php';
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
  echo "接続エラー: " . $e->getMessage();
  exit;
}

$stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css2?family=Yomogi&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>記事一覧 - 迷子の学習ブログ</title>
</head>
<body>
  <nav class="navbar">
    <a href="index.html">Home</a>
    <a href="blog.php">Blog</a>
    <a href="index.html#profile-card">About me</a>
  </nav>

  <div class="container">
    <h1>記事一覧</h1>

    <?php foreach ($articles as $article): ?>
      <div class="post">
        <h2>
          <a href="#"><?= htmlspecialchars($article['created_at']) ?> – <?= htmlspecialchars($article['title']) ?></a>
        </h2>
        <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
      </div>
    <?php endforeach; ?>

  </div>
</body>
</html>
