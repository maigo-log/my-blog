<?php
require_once 'db_config.php'; // パスワードなど安全に管理！

// 入力値を受け取る（POST送信）
$title = $_POST['title'];
$content = $_POST['content'];

// DBに接続して記事をINSERT
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
  $stmt = $pdo->prepare("INSERT INTO articles (title, content, created_at) VALUES (?, ?, NOW())");
  $stmt->execute([$title, $content]);

  // 投稿完了したらリダイレクト
  header("Location: blog.php");
  exit;
} catch (PDOException $e) {
  echo "エラー: " . $e->getMessage();
}
?>