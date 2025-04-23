<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新しい記事を書く</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <nav class="navbar">
    <a href="index.html">Home</a>
    <a href="blog.php">Blog</a>
    <a href="index.html#profile-card">About me</a>
    <a href="post.php">Post</a>
  </nav>

  <div class="container">
    <h1>新しい記事を書く</h1>
    <form class="post-form" action="submit.php" method="POST">
    
      <label for="title">タイトル</label><br>
      <input type="text" name="title" id="title" required><br><br>

      <label for="content">本文</label><br>
      <textarea name="content" id="content" rows="10" required></textarea><br><br>

      <button type="submit">投稿する</button>
    </form>
  </div>
</body>
</html>
