<?php
session_start();

if (isset($_SESSION) && !empty($_SESSION)) {
  echo "セッション内のデータ一覧:<br>";

  foreach ($_SESSION as $key => $value) {
      echo "$key: $value<br>";
  }
} else {
  echo "セッションにデータは保存されていません。";
}

// DB設定を定数で指定
define('DSN', 'mysql:host=db;dbname=php_portfolio;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']); //定数でheaderURL指定

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

// DBの内容を表示
$sql = "SELECT * FROM threads";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); //連想配列で取得

// 使用関数群

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

// fomr内容を取得してDBに登録
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  add_todo($pdo);
  header('Location: ' . SITE_URL);
  exit;
};


// //データーをjsからセッションに保管
// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $dataValue = $_POST['dataValue'];
//   echo ($dataValue);
//   $_SERVER['saved_data'] =$dataValue;
//   http_response_code(200);
// } else {
//   http_response_code(400);
// }


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