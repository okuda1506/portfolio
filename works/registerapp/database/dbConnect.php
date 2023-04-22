<?php
require_once('db.php');
try {
  $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
}
