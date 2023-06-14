<?php
session_start();

//クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

// セッションを削除
$_SESSION = array();
if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time(), -42000, $params["path"], $params["domain"], $params["secure"]);
}
session_destroy();

// Cookieを削除
setcookie('email', '', time() - 3600);
setcookie('password', '', time() - 3600);

header('Location: login.php');
exit();
