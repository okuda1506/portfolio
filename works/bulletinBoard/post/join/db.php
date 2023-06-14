<?php
require_once('../../../../config/config.php');

$dbName = DB_NAME_BULLETIN_BOARD;
$user = DB_USER;
$password = DB_PASSWORD;
$host = DB_HOST;
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
