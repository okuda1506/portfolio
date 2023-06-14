<?php
//クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

require('dbconnect.php');

session_start();

if (isset($_COOKIE['email']) && $_COOKIE['email'] != '') {
  $_POST['email'] = $_COOKIE['email'];
  $_POST['password'] = $_COOKIE['password'];
  $_POST['save'] = 'on';
}

if (!empty($_POST)) {
  // ログイン処理
  if ($_POST['email'] != '' && $_POST['password'] != '') {
    $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));
    $member = $login->fetch();

    if ($member) {
      // ログイン成功
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      // ログイン情報を記録
      if ($_POST['save'] == 'on') {
        setcookie('email', $POST['email'], time() + 60 * 60 * 24 * 14);
        setcookie('password', $_POST['password'], time() + 60 * 60 * 24 * 14);
      }

      header('Location: index.php');
      exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
  }
}

function h($value)
{
  return htmlspecialchars($value, ENT_QUOTES);
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
      <h1>ログインする</h1>
    </div>
    <div id="content">
      <div id="lead">
        <p>メールアドレスとパスワードを記入してログインしてください。</p>
        <p>入会手続きがまだの方はこちらからどうぞ。</p>
        <p>&raquo;<a href="join/">入会手続きをする </a></p>
        <form action="" method="post">
          <dl>
            <dt>メールアドレス</dt>
            <dd>
              <input id="column" type="text" name="email" size="35" maxlength="255" value="<?php if (isset($_POST['email'])) {
                                                                                  echo h($_POST['email']);
                                                                                } ?>">
              <?php if (isset($error['login']) && $error['login'] == 'blank') : ?>
                <p class="error">* メールアドレスとパスワードをご記入ください</p>
              <?php endif; ?>
              <?php if (isset($error['login']) && $error['login'] == 'failed') : ?>
                <p class="error">* ログインに失敗しました。正しくご記入ください</p>
              <?php endif; ?>
            </dd>
            <dt>パスワード</dt>
            <dd>
              <input id="column" type="password" name="password" size="35" maxlength="255" value="<?php if (isset($_POST['password'])) {
                                                                                        echo h($_POST['password']);
                                                                                      } ?>">
            </dd>
            <dt>ログイン情報の記載</dt>
            <dd>
              <input id="save" type="checkbox" name="save" value="on"><label for="save">次回からは自動的にログインする</label>
            </dd>
          </dl>
          <div><input type="submit" value="ログインする"></div>
          <br>
          <p><a href="top.html">トップへ戻る</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>