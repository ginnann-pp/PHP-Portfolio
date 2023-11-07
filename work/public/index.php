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
  if (isset($_POST['submit'])) {
    $selectedSubmit_index = $_POST['submit'];

    switch ($selectedSubmit_index) {
      case 'reset_thread_ID':
        echo "restがおされました";
        reset_session_ID($pdo);
        header('Location: ' . SITE_URL);
        break;

      case 'add_thread':
        echo "add_trheadがおされました";
        add_todo($pdo);
        header('Location: ' . SITE_URL);
        exit;
        break;

      default:
        echo "不明なオプションです";
    }
  } else {
    echo "選択されていません";
  }
} else {
  echo "POST送信されていません";
}

// user_thread_IDを0にして、sessions_IDを更新
function reset_session_ID($pdo) {
  $user_ID = $_SESSION['user-thread-id'];

  $sql = "UPDATE `users` SET `thread-id` = '0' WHERE `users`.`id` = :user_ID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue('user_ID', $user_ID, PDO::PARAM_INT);
  $stmt->execute();

  // sessionも0に変更
  $_SESSION['user-thread-id'] = 0;
}

// DBに追加
function add_todo($pdo)
{
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

  <h1>threadID:<?= $_SESSION['threadID']; ?></h1>
  <h1>userID: <?= $_SESSION['user-thread-id']; ?></h1>
  <h1><?= $_SESSION['userName']; ?></h1>

  <h1><a href="./screens/log-in.php">ログイン</a></h1>
  <!-- アカウントログイン -->
  <header>
    <div class="app-header">
      <h3>掲示板アプリ</h3>
      <p>ユーザー名</p>
    </div>
  </header>

  <!-- Thrad=IDの初期化 -->
  <form action="" method="POST">
    <input type="submit" name="submit" value="reset_thread_ID">
  </form>

  <!-- 掲示板作成fomr -->
  <section>
    <form action="" method="POST">
      <input type="text" name="title">
      <input type="submit" name="submit" value="add_thread">
    </form>
    <!-- DBにタイトルを決めて登録 -->
  </section>

  <!-- for文でtitleを表示 -->
  <div class="grid">
    <?php foreach ($data as $val) : ?>
      <div class="item" data-thread-id="<?= $val["id"]; ?>">
        <p><?= $val["title"]; ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <script src="./JS/main.js"></script>

</body>

</html>

<script>
  confirm('掲示板から離席しますか？') {
    
  }
</script>