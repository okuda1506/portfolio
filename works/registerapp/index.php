<?php
session_start();
// クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

if (!isset($_SESSION['token'])) {
  $token = bin2hex(random_bytes(32));
  $_SESSION["token"] = $token;
}

if (isset($_POST['register']) && !empty($_POST)) {
  if ($_POST['lastName'] == '') {
    $errorFlg['lastName'] = 'blank';
  }
  if ($_POST['firstName'] == '') {
    $errorFlg['firstName'] = 'blank';
  }
  if ($_POST['email'] == '') {
    $errorFlg['email'] = 'blank';
  }

  if (empty($errorFlg)) {
    if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
      $_SESSION['register'] = $_POST;
      // テーブルにinsertして登録完了通知メール送信
      require_once('insertTable.php');
      // メール送信は一旦停止
      // require_once('sendMail.php');
      header('Location: registerList.php');
      exit();
    } else {
      echo '不正なリクエストです。最初から登録し直して下さい。';
      exit();
    }
  }
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>個人情報登録アプリ</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <div class="register">
      <h1>登録画面</h1>
      <p>フォームを入力してください。</p>
      <p class="note">※ 個人情報の登録はお控えください。</p>
      <form method="post" action="">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
        <div class="info">
          <h2>お名前</h2>
          <div class="nameInfo">
            <div class="lastName">
              <p>姓：</p>
              <input type="text" name="lastName" value="<?php if (isset($_POST['lastName'])) {
                                                          echo h($_POST['lastName']);
                                                        } ?>">
            </div>
            <?php if (isset($errorFlg['lastName'])) : ?>
              <p class="error">* 姓を入力してください。</p>
            <?php endif; ?>
            <div class="middleName">
              <p>ミドル：</p>
              <input type="text" name="middleName" value="<?php if (isset($_POST['middleName'])) {
                                                            echo h($_POST['middleName']);
                                                          } ?>">
            </div>
            <div class="firstName">
              <p>名：</p>
              <input type="text" name="firstName" value="<?php if (isset($_POST['firstName'])) {
                                                            echo h($_POST['firstName']);
                                                          } ?>">
            </div>
            <?php if (isset($errorFlg['firstName'])) : ?>
              <p class="error">* 名を入力してください。</p>
            <?php endif; ?>
          </div>
          <h2>メールアドレス</h2>
          <input type="email" name="email" value="<?php if (isset($_POST['email'])) {
                                                    echo h($_POST['email']);
                                                  } ?>">
          <?php if (isset($errorFlg['email'])) : ?>
            <p class="error">* メールアドレスを入力してください。</p>
          <?php endif; ?>
        </div>
        <input class="registerBtn" type="submit" name="register" value="登録">
      </form>
    </div>
  </div>
</body>

</html>