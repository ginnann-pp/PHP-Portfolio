<?php 

session_start();

$raw = file_get_contents(('php://input'));
$data = json_decode($raw); //int型のthreadID

// セッションに保存されている値を取得
$user_ID = $_SESSION['user-thread-id'];

// JavaScriptから送信された値とセッションの値を比較
if ($data->threadId === $user_ID) {
    // 一致する場合の処理
    $response = ["message" => "一致しました"];
} else {
    // 一致しない場合の処理
    $response = ["message" => "一致しません"];
}

    $_SESSION['threadID'] = $data;
    $threadId = $_SESSION['threadID'];

    header('Content-Type: application/json');
    echo json_encode($threadId);

// session[threadID]が０なら JSONIDをuserテーブルに保存

// session[threadID]とJSONが違うならアラート、画面移動なし