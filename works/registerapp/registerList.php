<?php
session_start();
if (!isset($_SESSION['register'])) {
  header('Location: index.php');
  exit();
}

require_once('database/dbConnect.php');

if (isset($_POST['search'])) {
  // 検索
  $searchEmail = $_POST['searchEmail'];
  $records = $db->query("SELECT * FROM people WHERE email LIKE '%$searchEmail%' ORDER BY id DESC");
} else {
  $records = $db->query('SELECT * FROM people ORDER BY id DESC');
}
// DB切断
$db = null;

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
      <h1>登録データ一覧</h1>
      <form action="" method="POST">
        <div class="search">
          <p>メールアドレス：</p>
          <input class="searchWord" name="searchEmail" type="text">
          <input type="submit" class="searchBtn" name="search" value="検索">
          <p class="all"><a href="registerList.php"> | 全件表示</a></p>
        </div>
        <?php if ($records->rowCount() == 0) : ?>
          <div class="noResult">
            <p>該当するレコードは見つかりませんでした。</p>
          </div>
        <?php else : ?>
          <table class="registerList">
            <tr>
              <th class="column">id</th>
              <th class="column">姓</th>
              <th class="column">ミドル</th>
              <th class="column">名</th>
              <th class="column">メールアドレス</th>
            </tr>
            <?php foreach ($records as $record) : ?>
              <tr>
                <td class="data"><?php echo h($record['id']); ?></td>
                <td class="data"><?php echo h($record['lastName']); ?></td>
                <td class="data"><?php echo h($record['middleName']); ?></td>
                <td class="data"><?php echo h($record['firstName']); ?></td>
                <td class="data"><?php echo h($record['email']); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </form>
      <div class="btn">
        <button onClick="location.href='index.php'">入力へ</button>
        <button onClick="location.href='outputCsv.php'">CSVダウンロード</button>
      </div>
    </div>
  </div>
</body>

</html>