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
        <form method="post" action="register.php">
            <label for="username">ユーザー名：</label>
            <input type="text" name="username" id="username" required>

            <label for="email">メールアドレス：</label>
            <input type="email" name="email" id="email" required>

            <label for="password">パスワード：</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="アカウント作成">
        </form>
    </div>
</body>
</html>
