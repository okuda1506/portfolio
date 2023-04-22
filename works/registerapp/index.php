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
        <table>
          <tr>
            <th>お名前: </th>
            <td>
              姓: <input type="text" name="lastName" value="<?php if (isset($_POST['lastName'])) {
                                                              echo h($_POST['lastName']);
                                                            } ?>">
              ミドル: <input type="text" name="middleName" value="<?php if (isset($_POST['middleName'])) {
                                                                  echo h($_POST['middleName']);
                                                                } ?>">
              名: <input type="text" name="firstName" value="<?php if (isset($_POST['firstName'])) {
                                                              echo h($_POST['firstName']);
                                                            } ?>">
            </td>
          </tr>
          <?php if (isset($errorFlg['lastName'])) : ?>
            <tr class="error">
              <th></th>
              <td>* 姓を入力してください。</td>
            </tr>
          <?php endif; ?>
          <?php if (isset($errorFlg['firstName'])) : ?>
            <tr class="error">
              <th></th>
              <td>* 名を入力してください。</td>
            </tr>
          <?php endif; ?>
          <tr>
            <th>メールアドレス: </th>
            <td>
              <input type="email" name="email" value="<?php if (isset($_POST['email'])) {
                                                        echo h($_POST['email']);
                                                      } ?>">
            </td>
          </tr>
          <?php if (isset($errorFlg['email'])) : ?>
            <tr class="error">
              <th></th>
              <td>* メールアドレスを正しく入力してください。</td>
            </tr>
          <?php endif; ?>
          <tr>
            <th></th>
            <td><input type="submit" name="register" value="登録"></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</body>

</html>