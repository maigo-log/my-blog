<?php
// db_config 読み込み（接続情報）
require_once 'db_config.php';

// id が URL にない or 空だったら弾く
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: blog.php");
    exit;
}

// DB接続
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    echo "DB接続エラー: " . $e->getMessage();
    exit;
}

// SQL実行（指定されたIDを削除）
$id = intval($_GET['id']); // 念のため整数変換しておく
$stmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// 削除後は記事一覧へ戻る
header("Location: blog.php?deleted=1");
exit;
?>