<?php
session_start();

echo ($_SESSION['threadID']);
$threadID = $_SESSION['threadID'];

// DB設定を定数で指定
define('DSN', 'mysql:host=db;dbname=php_portfolio;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
define('SITE_URLS', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); //定数でheaderURL指定

// PDOでphp_portfolio DBに接続
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

// WHERE句で指定したthread_id取得
$sql = "SELECT * FROM posts WHERE thread_id = (:id)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue('id', $threadID);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //連想配列で取得

// formの内容をDBに挿入
// POSTで受け取り
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  add_comment($pdo);
  header('Location:' . SITE_URLS);
  exit();
}

// form内容取得関数
function add_comment($pdo)
{
  $comment = filter_input(INPUT_POST, 'comment');
  if ($comment === '') {
    return;
  }

  $threadID = $_SESSION['threadID'];

  // sql文作成
  $sql = "INSERT INTO `posts` (`id`, `thread_id`, `content`, `created_at`) VALUES (NULL, :thread_id, :comment, CURRENT_TIMESTAMP);"; // プレースホルダー内のシングルクォートを削除
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':thread_id', $threadID, PDO::PARAM_INT);
  $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
  $stmt->execute();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>掲示板チャット</title>
  <link rel="stylesheet" type="text/css" href="../css/chat.css">
</head>

<body>
  <header>
    <h1>投稿画面</h1>
  </header>

  <!-- for文でccontentを表示 -->
  <section class="grid">
    <ul>
      <?php foreach ($data as $val) : ?>
        <li>
          <p><?= $val["thread_id"]; ?></p>
          <p>  :  </p>
          <p><?= $val["content"]; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>

  <!-- DBにタイトルを決めて登録 -->
  <section>
    <form action="" method="POST">
      <input type="text" name="comment">
      <input type="submit" value="追加">
      <br>
    </form>
  </section>


  <a href="../index.php">Home</a>
</body>

</html>