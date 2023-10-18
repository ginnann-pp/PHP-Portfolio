<?php
require_once(__DIR__ . '/../../app/Props/Config.php');

use MyApp\Database;

$pdo = Database::getInstance();


// fomrで受けと取り、DBに同じものがあればセッションに保存
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    userCheck($pdo);
    // チェックが良ければセッションに保存
    // 掲示板画面に画面推移
};

function userCheck($pdo)
{
    // formでうけっとったname.passwordを変数に代入
    $name = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    // DBにあたいがあるか確認
    $sql = "SELECT * FROM users WHERE name = :name AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC); //連想配列で取得

    if ($user) {
        foreach($user as $user) {
            echo $user['name'];
            echo "</br>";
            echo $user['password'];
        }
        } else {
        // ない場合（ログイン失敗）
        echo "アカウントがないよ";
    }
};

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" type="text/css" href="../css/log-in.css">
</head>

<body>

    <h1><a href="../index.php">掲示板</a></h1>

    <div class="login-container">
        <h2>ログイン</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">ユーザー名:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">ログイン</button>
        </form>
        <button id="creat" type="submit">
            <a href="./add-user.php">アカウント作成</a>
        </button>
    </div>


</body>

</html>