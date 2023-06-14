<?php
session_start();

//クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

require('dbconnect.php');

if (!isset($_SESSION['id'])) {
  header('Location: index.php');
  exit();
}

$info = $db->prepare('SELECT * FROM members WHERE id=?');
$info->execute(array($_SESSION['id']));
$delInfo = $info->fetch();

// プロフィール写真削除
$delFilePath = 'member_picture/' . $delInfo['picture'];
if (file_exists($delFilePath)) {
  unlink($delFilePath);
}

// 投稿削除
$delPost = $db->prepare('DELETE FROM posts WHERE member_id=?');
$delPost->execute(array($_SESSION['id']));

// アカウント削除
$delMember = $db->prepare('DELETE FROM members WHERE id=?');
$delMember->execute(array($_SESSION['id']));

// セッション、Cookieを削除
$_SESSION = array();
session_destroy();
setcookie('email', '', time() - 3600);
setcookie('password', '', time() - 3600);
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
      <h1>アカウント削除</h1>
    </div>
    <div id="content">
      <p>ご利用ありがとうございました</p>
      <p><a href="index.php">トップへ</a></p>
    </div>
  </div>
</body>

</html>