<?php
require_once 'db_config.php';

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if (!$id || !$title || !$content) {
  echo "入力に不備があります。";
  exit;
}

try {
  $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");
  $stmt->execute([$title, $content, $id]);

  // 編集完了したらトップに戻す
  header("Location: blog.php?updated=1"); 
  exit;
} catch (PDOException $e) {
  echo "更新に失敗しました：" . $e->getMessage();
  exit;
}
?>
