<?php 

session_start();

$raw = file_get_contents(('php://input'));
$data = json_decode($raw);

// セッションの値とJSONで来た値の判断

// session[threadID]とJSON.threadIdが同じなら、そのまま画面移動

// session[threadID]が０なら JSONIDをuserテーブルに保存

// session[threadID]とJSONが違うならアラート、画面移動なし

$_SESSION['threadID'] = $data;
$threadId = $_SESSION['threadID'];


echo json_encode($threadId);