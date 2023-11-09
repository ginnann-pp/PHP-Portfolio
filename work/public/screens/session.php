<?php
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw);

if (!empty($_SESSION['user-thread-id'])) {
    // セッションに保存されている値を取得
    $user_ID = $_SESSION['user-thread-id'];

    // JavaScriptから送信された値とセッションの値を比較
    if ($data->threadId == $user_ID) {
        // 一致する場合の処理
        $response = [
            "message" => "一致しました",
            "respons_ID" => $data->threadId
        ];
        $_SESSION['threadID'] = $data->threadId;
    } else if ($user_ID === 0) {
        // UserIDが0の場合
        $response = [
            "message" => "あたいがゼロなので観覧モード",
            "respons_ID" => $user_ID
        ];
        $_SESSION['threadID'] = $data->threadId;
    } else {
        // 他の掲示板にログインをしているので画面移動はなし
        $response = [
            "message" => "他の掲示板にログインしているので画面移動はできません",
        ];
    }
} else {
    $response = [
        "message"  =>'ログインしていないと使えない機能です',
        "login_check" => 'true'
    ];
}


// ヘッダーを設定してJSONレスポンスを返す
header('Content-Type: application/json');
echo json_encode($response);
