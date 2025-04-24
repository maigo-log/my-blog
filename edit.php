<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/db_config.php'; // ← 確実に現在のフォルダから読み込む

$id = $_GET['id'] ?? null;

if (!$id) {
  echo "記事IDがありません。";
  exit;
}

// DBから該当記事を取得
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
  echo "記事が見つかりません。";
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>記事を編集する</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <a href="index.php">Home</a>
    <a href="blog.php">Blog</a>
    <a href="index.html#profile-card">About me</a>
    <a href="post.php">新規投稿</a>
  </nav>

  <div class="container">
    <h1>記事を編集する</h1>
    <form class="post-form" action="update.php" method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
      
      <label for="title">タイトル</label><br>
      <input type="text" name="title" id="title" value="<?= htmlspecialchars($article['title']) ?>" required><br><br>

      <label for="content">本文</label><br>
      <textarea name="content" id="content" rows="10" required><?= htmlspecialchars($article['content']) ?></textarea><br><br>

      <button type="submit">更新する</button>
    </form>
  </div>
</body>
</html>
