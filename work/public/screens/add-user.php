<?php
require_once(__DIR__ . '/../../app/Props/Config.php');

use MyApp\Database;

$pdo = Database::getInstance();

// POSTで取得
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addUser($pdo);
}

// addUser関数
function addUser ($pdo) {
    $userName = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    // DBに値があるか確認
    /* 重複チェック */
    $stmt = $pdo->prepare('SELECT * FROM users WHERE name=?');
    $stmt->bindValue(1, $_POST['username']);
    $stmt->execute();

    if (count($stmt->fetchAll())) {
        echo '使っているよ;';
      } else {
        echo '使っていないよ';
      }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント作成</title>
    <link rel="stylesheet" href="../css/add-user.css">
</head>
<body>

<h1><a href="./log-in.php">ログイン画面</a></h1>
    <div class="container">
        <h2>アカウント作成</h2>
        <form method="POST">
            <label for="username">ユーザー名：</label>
            <input type="text" name="username" id="username" required>

            <label for="password">パスワード：</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="アカウント作成">
        </form>
    </div>
</body>
</html>
