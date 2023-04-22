<?php
session_start();

//クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

// ログインしていなければ戻る
if (!isset($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ひとことSNS</title>
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <div id="wrap">
    <div id="head">
      <h1>退会画面</h1>
    </div>
    <div id="content">
      <p>退会しますか？</p>
      <p><a href="deleteAccount.php">退会へ</a> | <a href="index.php">トップへ戻る</a></p>
    </div>
  </div>
</body>

</html>