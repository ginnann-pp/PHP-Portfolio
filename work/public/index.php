<?php

require_once(__DIR__ . '/../app/Props/Config.php');

use MyApp\Database;

$pdo = Database::getInstance();

// DBの内容を表示
$sql = "SELECT * FROM threads";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //連想配列で取得

// 使用関数群


// fomr内容を取得してDBに登録
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  add_todo($pdo);
  header('Location: ' . SITE_URL);
  exit;
};

// DBに追加
function add_todo($pdo) {
  $title = trim(filter_input(INPUT_POST, 'title'));
  if ($title === '') {
    return;
  }

  // prepareでDBにinput内容挿入
  $sql = "INSERT INTO threads (title) VALUES (:title)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue('title', $title, PDO::PARAM_STR);
  $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/styles.css">
  <title>Document</title>
</head>

<body>
  <header>
    <h1>掲示板アプリ</h1>
  </header>

  <section>
    <form action="" method="POST">
      <input type="text" name="title">
      <input type="submit" value="追加">
    </form>
    <!-- DBにタイトルを決めて登録 -->
  </section>

<!-- for文でtitleを表示 -->
  <div class="grid">
    <?php foreach ($data as $val) : ?>
      <div class="item" data-thread-id="<?= $val["id"] ;?>">
        <p><?= $val["title"]; ?></p>
      </div>
      <?php endforeach; ?> 
  </div>


  <a href="./screens/chat.php">移動</a>

  <script src="./JS/main.js"></script>

</body>

</html>