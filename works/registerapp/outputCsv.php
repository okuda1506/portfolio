<?php
require_once('database/dbConnect.php');
// 出力するcsvファイル情報を定義
$fileName = 'people_' . date('YmdHis') . '.csv';
$header = ['id', '姓', 'ミドル', '名', 'メールアドレス'];
$records = $db->query('SELECT * FROM people');
// ファイルopen
$createCsvFile = fopen('php://output', 'w');
// 文字化け対策
mb_convert_variables('SJIS-win', 'UTF-8', $header);
// ヘッダーwrite
fputcsv($createCsvFile, $header);

foreach ($records as $record) {
  $csv = [$record['id'], $record['lastName'], $record['middleName'], $record['firstName'], $record['email']];
  mb_convert_variables('SJIS-win', 'UTF-8', $csv);
  fputcsv($createCsvFile, $csv);
}
// ファイルclose
fclose($createCsvFile);
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename={$fileName}");
header('Content-Transfer-Encoding: binary');
$db = null;
exit;
