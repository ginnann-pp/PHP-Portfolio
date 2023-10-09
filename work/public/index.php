<?php

define('DSN', 'mysql:host=db;dbname=php_portfolio;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
// DB設定を定数で指定

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //連想配列
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外
    PDO::ATTR_EMULATE_PREPARES => false, //SQLインジェクション対策
  ]);
  echo '接続成功';
} catch (PDOException $e) {
  echo '接続失敗' . $e->getMessage() . "\n";
  exit();
}
// PDOでphp_portfolio DBに接続

$sql = "SELECT * FROM threads";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //連想配列で取得


// fomr内容を取得してDBに登録



$add_threads = filter_input(INPUT_GET, "title");


// $stmt_add = $pdo->prepare("INSERT INTO  threads (title) VALUES (:title)");
// $stmt_add->bindValue('title', $add_threads, \PDO::PARAM_STR);
// if ($stmt_add->execute()) {
//   // データの挿入が成功した場合の処理
//   echo "データが正常に追加されました。";
// } else {
//   // データの挿入が失敗した場合の処理
//   echo "エラー：データの追加に失敗しました。";
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles.css">
  <title>Document</title>
</head>

<body>
  <header>
    <h1>掲示板アプリ</h1>
  </header>

  <section>
    <form action="GET">
      <input type="text" name="title">
      <input type="submit" value="追加">
    </form>
    <!-- DBにタイトルを決めて登録 -->
  </section>


  <div class="grid">
    <?php foreach ($data as $val) : ?>
      <div class="item">
        <p><?= $val["title"]; ?></p>
      </div>
    <?php endforeach; ?> <!-- for文でtitleを表示 -->
  </div>


</body>

</html>