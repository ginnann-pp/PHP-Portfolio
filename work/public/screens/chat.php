<?php
session_start();

echo ($_SESSION['count']);

// DB設定を定数で指定
define('DSN', 'mysql:host=db;dbname=php_portfolio;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');

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
$sql = "SELECT * FROM posts WHERE thread_id = 2";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //連想配列で取得

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
    <?php foreach ($data as $val) : ?>
        <li>
        <p><?= $val["thread_id"]; ?></p>
        <p><?= $val["content"]; ?></p>
        </li>
    <?php endforeach; ?> 
</section>

<!-- DBにタイトルを決めて登録 -->
<section>
    <form action="" method="POST">
      <input type="text" name="title">
      <input type="submit" value="追加">
      <br>
    </form>
  </section>
    

    <a href="../index.php">Home</a>
</body>

</html>