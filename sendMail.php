<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;

require_once('config/config.php');
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
session_start();

if (!isset($_SESSION['send']) || empty($_SESSION["token"]) || !isset($_SESSION["token"])) {
	header('Location: index.php');
	exit();
}

try {
	$host = MAIL_HOST;
	$user = MAIL_USER;
	$password = MAIL_PASSWORD;
	// 差出人
	$from = $user;
	$from_name = '奥田 拓也（自動返信システム）';
	// 宛先
	$toCustomer = h($_SESSION['send']['email']);
	// メールヘッダインジェクション対策
	$toCustomer = str_replace(array("\r\n", "\r", "\n"), '', $toCustomer);
	$toMyself = 'okuda1506@gmail.com';
	// 件名
	$subjectCustomer = '【奥田 拓也】お問い合わせを受け付けました。';
	$subjectMyself = '【奥田 拓也】お問い合わせ確認';
	// 本文
	$bodyCustomer = '※このメールはシステムからの自動返信です' . "\r\n"
		. "\r\n"
		. h($_SESSION['send']['name']) . ' 様' . "\r\n"
		. "\r\n"
		. '以下の内容でお問い合わせを受け付けました。' . "\r\n"
		. '回答まで今しばらくお待ちください。' . "\r\n"
		. "\r\n"
		. '※回答まで数日掛かる場合がございます。予めご了承下さい。' . "\r\n"
		. "\r\n"
		. '━━━━━━━━  お問い合わせ内容  ━━━━━━━━' . "\r\n"
		. "\r\n"
		. 'お名前：' . h($_SESSION['send']['name']) . "\r\n"
		. 'メールアドレス：' . h($_SESSION['send']['email']) . "\r\n"
		. 'お問い合わせ内容：' . "\r\n"
		. h($_SESSION['send']['message']) . "\r\n"
		. "\r\n"
		. '━━━━━━━━━━━━━━━━━━━━━━━━━' . "\r\n"
		. "\r\n"
		. '———————————————————————' . "\r\n"
		. '奥田 拓也' . "\r\n"
		. 'メール：okuda1506@gmail.com';

	$bodyMyself = '※このメールはシステムからの自動返信です' . "\r\n"
		. "\r\n"
		. h($_SESSION['send']['name']) . ' 様より、以下の内容でお問い合わせがありました。' . "\r\n"
		. 'ご確認ください。' . "\r\n"
		. "\r\n"
		. '━━━━━━━━  お問い合わせ内容  ━━━━━━━━' . "\r\n"
		. "\r\n"
		. 'お名前：' . h($_SESSION['send']['name']) . "\r\n"
		. 'メールアドレス：' . h($_SESSION['send']['email']) . "\r\n"
		. 'お問い合わせ内容：' . "\r\n"
		. h($_SESSION['send']['message']) . "\r\n"
		. "\r\n"
		. '━━━━━━━━━━━━━━━━━━━━━━━━━' . "\r\n";

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
	// お客様へメール送信
	$mail->addAddress($toCustomer);
	$mail->Subject = $subjectCustomer;
	$mail->Body = $bodyCustomer;
	$mail->send();
	$mail->clearAddresses();
	// 自分へメール送信
	$mail->addAddress($toMyself);
	$mail->Subject = $subjectMyself;
	$mail->Body = $bodyMyself;
	$mail->send();
} catch (Throwable $e) {
	$_SESSION['error'] = $e->getMessage() . 'エラーが発生しました。お手数ですが再度やり直してください。';
	header('Location: errorMessage.php');
	exit();
}
