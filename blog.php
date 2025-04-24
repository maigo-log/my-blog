<?php
require_once 'db_config.php';
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
  echo "接続エラー: " . $e->getMessage();
  exit;
}
$show_updated_message = isset($_GET['updated']);
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
    <a href="post.php">Post</a>
  </nav>

  <div class="container">

  <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
  <div class="alert alert-delete">記事を削除しました</div>
<?php endif; ?>

  <?php if ($show_updated_message): ?>
  <div class="alert success">
    ✨ 編集が完了しました！
  </div>
<?php endif; ?>

    <h1>記事一覧</h1>

    <?php foreach ($articles as $article): ?>
      <div class="post">
      <h2>
  <a href="article.php?id=<?= $article['id'] ?>">
    <?= htmlspecialchars($article['created_at']) ?> – <?= htmlspecialchars($article['title']) ?>
  </a>
</h2>

<script>
  setTimeout(function() {
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
      alertBox.classList.add('hide'); // フェードアウト開始
      setTimeout(() => {
        alertBox.remove(); // 完全に消す（DOMから削除）
      }, 1000); // CSSのtransitionと同じ1秒後に削除
    }
  }, 3000); // 表示後3秒待ってから消える
</script>


<script>
  setTimeout(function() {
    const alertBox = document.querySelector('.alert-delete');
    if (alertBox) {
      alertBox.classList.add('hide');
      setTimeout(() => {
        alertBox.remove();
      }, 1000); // CSSと合わせて1秒で消す
    }
  }, 3000); // 3秒後にフェードアウト
</script>

<?php
  $preview = mb_substr($article['content'], 0, 50); // 最初の100文字だけ
  echo nl2br(htmlspecialchars($preview)) . '...';
?>
<a href="article.php?id=<?= $article['id'] ?>">続きを読む</a>
<div class="btn-group">
  <a class="edit-btn" href="edit.php?id=<?= $article['id'] ?>">📝 編集</a>
  <a class="delete-btn" href="delete.php?id=<?= $article['id'] ?>" onclick="return confirm('本当に削除しますか？');">🗑️ 削除</a>
</div>
      </div>
    <?php endforeach; ?>

  </div>
</body>
</html>
