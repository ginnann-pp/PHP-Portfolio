<?php

// 読み込み先のファイルに最初に記述で先頭でセッション開始
session_start();

// DB設定を定数で指定
define('DSN', 'mysql:host=db;dbname=php_portfolio;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']); //定数でheaderURL指定

// // 同一ファイル内にあるClassを繰り返し読み込み
// sql_injection_subst(function ($class) {
//     // namespaseの先頭を変数で保存
//     $prefix = 'MyApp\\';

//     if (strpos($class, $prefix === 0)) {
//         $fileName = sprintf(__DIR__ . '/%s.php', substr($class, strlen($prefix)));

//         if(file_exists($fileName)) {
//             require($fileName);
//         } else {
//             echo 'File not found:' , $fileName;
//         }
//     }
// });

require_once(__DIR__ . '/Database.php');