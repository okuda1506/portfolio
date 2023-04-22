<?php
if (!isset($_SESSION['register'])) {
  header('Location: index.php');
  exit();
}

// PHPMailerの使用
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;

require 'php_mailer/vendor/autoload.php';
$mail = new PHPMailer(true);

try {
  //ホスト（さくらのレンタルサーバの初期ドメイン）
  $host = '';
  //メールアカウントの情報（さくらのレンタルサーバで作成したメールアカウント）
  $user = '';
  $password = '';
  //差出人
  $from = '';
  $from_name = '';
  //宛先
  $toCustomer = h($_SESSION['register']['email']);
  $toCustomer = str_replace(array("\r\n", "\r", "\n"), '', $toCustomer); //メールヘッダインジェクション対策
  //件名
  $subjectCustomer = '【個人情報登録アプリ】登録完了通知';
  //本文
  if ($_SESSION['register']) {
    # code...
  }
  $bodyCustomer = h($_SESSION['register']['lastName']) . h($_SESSION['register']['middleName']) . h($_SESSION['register']['firstName']) . ' 様' . "\r\n"
    . "\r\n"
    . 'ご利用ありがとうございます。' . "\r\n"
    . '登録が完了しました。';

  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = $host;
  $mail->Username = $user;
  $mail->Password = $password;
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->CharSet = "utf-8";
  $mail->Encoding = "base64";
  $mail->setFrom($from, $from_name);
  //登録ユーザーへ送信
  $mail->addAddress($toCustomer);
  $mail->Subject = $subjectCustomer;
  $mail->Body = $bodyCustomer;
  $mail->send();
  $mail->clearAddresses();
} catch (Throwable $e) {
  $_SESSION['error'] = $e->getMessage() . 'メール送信にてエラーが発生しました。お手数ですが再度やり直してください。';
  exit();
}
