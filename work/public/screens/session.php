<?php 
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw); // int型のthreadID

// セッションに保存されている値を取得
$user_ID = $_SESSION['user-thread-id'];

// JavaScriptから送信された値とセッションの値を比較
if ($data->threadId == $user_ID) { // 比較を修正
    // 一致する場合の処理
    $response = [
        "message" => "一致しました",
        "respons_ID" => $data->threadId];
    $_SESSION['threadID'] = $data->threadId; // セッションに保存する値を修正
} else {
    // 一致しない場合の処理
    $response = ["message" => "一致しません"];
}

// ヘッダーを設定してJSONレスポンスを返す
header('Content-Type: application/json');
echo json_encode($response);
